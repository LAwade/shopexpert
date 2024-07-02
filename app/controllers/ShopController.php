<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\models\Product;
use app\models\ProductSale;
use app\models\Sale;
use app\models\Tax;
use app\shared\Cart;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use PDOException;

class ShopController extends Controller
{

    private Cart $cartproduct;

    public function __construct()
    {
        $this->cartproduct = new Cart();
    }

    public function index()
    {
        redirect('shop/show');
    }

    public function show(int $id = null)
    {
        try {
            $info['categories'] = Category::where('active', 1)->orderBy('id')->get();

            if ($id) {
                $products = Product::where('active', 1)->where('category_id', $id)->orderBy('name')->get();
                foreach ($products as $product) {
                    $taxes = Tax::join('category_taxes', 'category_taxes.tax_id', '=', 'taxes.id')
                        ->where('category_taxes.category_id', $id)
                        ->get();
    
                    $product->taxes = $taxes;
                }   
                $product->taxes = $taxes;
                $info['products'] = $products;
            }
        } catch (PDOException $p) {
            logger("database_shop")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $info['selected'] = $id;
        $this->load('shop/show');
        $this->view('template', $info);
    }

    public function addcart(int $category_id)
    {
        $input = is_postback();
        try {
            if (!count($input)) {
                throw new Exception("Não foi possível verificar o ID do produto informado!");
            }
            $product = array_keys($input['product']);
            $this->shopCart($product[0]);
        } catch (Exception $e) {
            logger("database_cart")->error($e->getMessage());
        }
        redirect("shop/show/{$category_id}");
    }

    public function cart()
    {
        try {
            if (!session()->has('my_cart')) {
                throw new Exception("Não foi possível encontrar nenhum produto no carrinho!");
            }
            $cart = session()->data('my_cart')->getProduct();

            $data = Category::join('products', 'categories.id', '=', 'products.category_id')
                ->whereIn('products.id', $cart)
                ->get();

            /**
             * Verifica a quantidade adicionado no carrinho e cria 
             * uma atributo no retorno do banco com a quantidade 
             * para multiplicar na tela
             */
            foreach ($data as $product) {
                $count = 0;
                foreach ($cart as $c) {
                    if ($c == $product->id) {
                        $count += 1;
                    }
                }
                $taxes = Tax::join('category_taxes', 'category_taxes.tax_id', '=', 'taxes.id')
                    ->where('category_taxes.category_id', $product->category_id)
                    ->get();

                $product->taxes = $taxes;
                $product->quantity = $count;
            }   

            $info['products'] = $data;
        } catch (PDOException $p) {
            logger("database_shop")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $this->load('shop/cart');
        $this->view('template', $info);
    }

    public function sale()
    {
        $cart = session()->data("my_cart");
        try{
            DB::beginTransaction();
            $sale = new Sale();
            if(!$sale->save()){
                throw new Exception('Não foi possível registrar a compra!');
            }

            $productsCart = $cart->getProduct();
            foreach($productsCart as $product){
                $product_sale = new ProductSale();
                $product_sale->product_id = $product;
                $product_sale->sale_id = $sale->id;
                if(!$product_sale->save()){
                    throw new Exception('Não foi possível registrar os itens da compra!');
                }
            }

            session()->unset('my_cart');
            $this->message()->success("Sua compra foi registrada!")->flash();
            DB::commit();
        } catch (PDOException $p) {
            DB::rollBack();
            logger("database_sale")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            DB::rollBack();
            $this->message()->danger($e->getMessage())->flash();
        }

        redirect("shop/show");
    }

    private function shopCart(int $product_id)
    {
        $cart = session()->data("my_cart");
        if ($cart) {
            $this->cartproduct = $cart;
        }
        $this->cartproduct->setProduct($product_id);
        session()->set('my_cart', $this->cartproduct);
    }
}
