<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\models\ProductSale;
use app\models\Sale;
use app\models\Tax;
use Exception;
use PDOException;

class SaleController extends Controller
{

    public function __construct()
    {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('index/login');
        }
    }

    public function index()
    {
    }

    public function saled()
    {
        try {
            $sales = Sale::all();
            foreach ($sales as $sale) {
                $products = ProductSale::join('products', 'products.id', '=', 'product_sale.product_id')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->where('sale_id', $sale->id)
                    ->selectRaw('products.*, categories.name as category_name')
                    ->get();

                foreach ($products as $product) {
                    $taxes = Tax::join('category_taxes', 'category_taxes.tax_id', '=', 'taxes.id')
                        ->where('category_taxes.category_id', $product->category_id)
                        ->get();

                    $sale->taxes = $taxes;
                }

                $sale->products = $products;
            }
            $info['all'] = $sales;
        } catch (PDOException $p) {
            logger("database_sale")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $this->load('sale/saled');
        $this->view('template', $info);
    }
}
