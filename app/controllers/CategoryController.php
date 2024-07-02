<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use Valitron\Validator;
use Exception;
use PDOException;

class CategoryController extends Controller
{

    function __construct()
    {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
    }

    public function index()
    {
        $info['all'] = Category::orderBy('id')->get();
        $this->load('category/index');
        $this->view('template', $info);
    }

    public function edit($id)
    {
        try {
            if ($id) {
                $category = Category::find($id);
            }
            $info['all'] = Category::all();
            $info['category'] = $category;
        } catch (PDOException $p) {
            logger("database_category")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $this->load('category/index');
        $this->view('template', $info);
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

            $category = new Category();
            if ($id) {
                $category = Category::find($id);
            }

            $category->name = $input['name'];
            $category->active = $input['active'] ?? 0;

            if (!$category->save()) {
                throw new Exception('A categoria não pode ser registrada!');
            }
            $this->message()->success("Categoria foi registrada!")->flash();

            $info['all'] = Category::all();
        } catch (PDOException $p) {
            logger("database_category")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        redirect('category/index');
    }

    public function delete($id)
    {
        try {
            if (!$id) {
                throw new Exception('A categoria não pode ser encontrada!');
            }

            $category = Category::find($id);
            if (!$category->delete()) {
                throw new Exception('A categoria não pode ser removida!');
            }
            $this->message()->success("Categoria foi removida!")->flash();
        } catch (PDOException $p) {
            logger("database_category")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        redirect('category/index');
    }
}
