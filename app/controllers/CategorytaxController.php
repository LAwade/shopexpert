<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\models\CategoryTax;
use app\models\Tax;
use Exception;
use PDOException;

class CategorytaxController extends Controller
{

    function __construct()
    {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('index/login');
        }
    }

    public function index()
    {
        $info['categories'] = Category::where('active', 1)->orderBy('id')->get();
        $this->load('categorytax/index');
        $this->view('template', $info);
    }

    public function store()
    {
        $input = is_postback();
        try {
            if (isset($input['add'])) {
                $exist = CategoryTax::where('category_id', $input['category_id'])
                    ->where('tax_id', $input['tax_id_add'])
                    ->get();

                if(count($exist)){
                    throw new Exception('Esse imposto já foi adicionado ao produto!');
                }

                $ctax = new CategoryTax();
                $ctax->category_id = $input['category_id'];
                $ctax->tax_id = $input['tax_id_add'];
                if (!$ctax->save()) {
                    throw new Exception('Não foi possível adicionar o imposto no produto!');
                }
                $this->message()->success('Imposto foi adicionado no produto!')->flash();
            }

            if (isset($input['rm'])) {
                $ctax = CategoryTax::find($input['tax_id_rm']);
                if (!$ctax->delete()) {
                    throw new Exception('O imposto do produto não pode ser removido!');
                }
                $this->message()->success('Imposto foi removido no produto!')->flash();
            }

            if (isset($input['select']) || isset($input['add']) || isset($input['rm'])) {
                $categoryTaxIds = CategoryTax::where('category_id', $input['category_id'])->select('tax_id')->get()->pluck('tax_id');

                $categoryId = $input['category_id'];
                $info['categorytaxes'] = Tax::join('category_taxes', function($join) use ($categoryId) {
                        $join->on('category_taxes.tax_id', '=', 'taxes.id')
                            ->where('category_taxes.category_id', '=', $categoryId);
                        }
                    )
                    ->whereIn('taxes.id', $categoryTaxIds)
                    ->selectRaw('category_taxes.id as ctx_id, taxes.name as tax_name, taxes.id as tax_id')
                    ->get();

                $info['taxes'] = Tax::whereNotIn('taxes.id', $categoryTaxIds)->get();
            }

        } catch (PDOException $p) {
            logger("database_categorytax")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $info['categories'] = Category::where('active', 1)->orderBy('id')->get();
        $info['selected'] = $input['category_id'];
        $this->load('categorytax/index');
        $this->view('template', $info);
    }
}
