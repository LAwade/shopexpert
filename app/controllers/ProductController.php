<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\models\Product;
use Valitron\Validator;
use Exception;
use PDOException;


class ProductController extends Controller {

    private $categories;
    private $products;
    
    function __construct()
    {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
        $this->categories = Category::where('active', 1)->get();
        $this->products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->selectRaw('products.*, categories.name as category_name')
        ->orderBy('id')->get();
    }

    public function index()
    {
        $info['all'] = $this->products;
        $info["categories"] = $this->categories;
        $this->load('product/index');
        $this->view('template', $info);
    }

    public function edit($id)
    {
        try {
            if ($id) {
                $product = Product::find($id);
            }
            $info['all'] = $this->products;
            $info["categories"] = $this->categories;
            $info['product'] = $product;
        } catch (PDOException $p) {
            logger("database_product")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $this->load('product/index');
        $this->view('template', $info);
    }

    public function delete($id)
    {
        try {
            if (!$id) {
                throw new Exception('O produto não pode ser encontrado!');
            }

            $product = Product::find($id);
            if (!$product->delete()) {
                throw new Exception('O produto não pode ser removido!');
            }
            $this->message()->success("Produto foi removido!")->flash();
        } catch (PDOException $p) {
            logger("database_product")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        redirect('product/index');
    }

    public function save($id = null)
    {
        $input = is_postback();
        $message = null;

        // Defina as regras de validação
        $v = new Validator($input);
        $v->rule('required', 'name');
        $v->rule('lengthMax', 'name', 255);
        $v->rule('lengthMin', 'name', 3);

        $v->rule('required', 'description');
        $v->rule('lengthMax', 'description', 500);
        $v->rule('lengthMin', 'description', 3);

        $v->rule('required', 'price');
        $v->rule('required', 'category_id');

        try {
            $v->validate();
            if($v->errors()){
                foreach ($v->errors() as $errors) {
                    foreach ($errors as $error) {
                        $message .= $error . " \n";
                    }
                }
                throw new Exception($message);
            }

            $product = new Product();
            if ($id) {
                $product = Product::find($id);
            }

            $product->name = $input['name'];
            $product->description = $input['description'];
            $product->price = $input['price'];
            $product->category_id = $input['category_id'];
            $product->active = $input['active'] ?? '0';

            if (!$product->save()) {
                throw new Exception('O produto não pode ser registrado!');
            }
            $this->message()->success("Produto foi registrado!")->flash();

            $info['all'] = Product::all();
        } catch (PDOException $p) {
            logger("database_product")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        redirect('product/index');
    }
}