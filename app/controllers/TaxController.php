<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\models\Tax;
use Exception;
use PDOException;
use Valitron\Validator;

class TaxController extends Controller {

    private array $states;

    function __construct()
    {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
        $this->states = [
            "AC" => "Acre", "AL" => "Alagoas", "AP" => "Amapá", "AM" => "Amazonas",
            "BA" => "Bahia", "CE" => "Ceará", "DF" => "Distrito Federal", "ES" => "Espírito Santo",
            "GO" => "Goiás", "MA" => "Maranhão", "MT" => "Mato Grosso", "MS" => "Mato Grosso do Sul",
            "MG" => "Minas Gerais", "PA" => "Pará", "PB" => "Paraíba", "PR" => "Paraná",
            "PE" => "Pernambuco", "PI" => "Piauí", "RJ" => "Rio de Janeiro", "RN" => "Rio Grande do Norte",
            "RS" => "Rio Grande do Sul", "RO" => "Rondônia", "RR" => "Roraima", "SC" => "Santa Catarina",
            "SP" => "São Paulo", "SE" => "Sergipe",  "TO" => "Tocantins"
        ];
    }

    public function index()
    {
        $info['all'] = Tax::orderBy('id')->get();
        $info['estados'] = $this->states;
        $this->load('tax/index');
        $this->view('template', $info);
    }

    public function edit($id)
    {
        try {
            if ($id) {
                $tax = Tax::find($id);
            }
            $info['all'] = Tax::all();
            $info['estados'] = $this->states;
            $info['tax'] = $tax;
        } catch (PDOException $p) {
            logger("database_tax")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $this->load('tax/index');
        $this->view('template', $info);
    }

    public function delete($id)
    {
        try {
            if (!$id) {
                throw new Exception('O imposto não pode ser encontrado!');
            }

            $tax = Tax::find($id);
            if (!$tax->delete()) {
                throw new Exception('O imposto não pode ser removido!');
            }
            $this->message()->success("Imposto foi removido!")->flash();
        } catch (PDOException $p) {
            logger("database_tax")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        redirect('tax/index');
    }

    public function save($id = null)
    {
        $input = is_postback();
        $message = null;

        // Defina as regras de validação
        $v = new Validator($input);
        $v->rule('required', 'name');
        $v->rule('lengthMax', 'name', 255);
        $v->rule('lengthMin', 'name', 1);

        $v->rule('required', 'rate');
        $v->rule('regex', 'rate', '/^(0(\.\d+)?|1(\.0+)?)$/');

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

            $tax = new Tax();
            if ($id) {
                $tax = Tax::find($id);
            }

            $tax->name = $input['name'];
            $tax->rate = $input['rate'];
            $tax->region = strtoupper($input['region']);

            if (!$tax->save()) {
                throw new Exception('O imposto não pode ser registrado!');
            }
            $this->message()->success("Imposto foi registrado!")->flash();

            $info['all'] = Tax::all();
        } catch (PDOException $p) {
            logger("database_tax")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        redirect('tax/index');
    }
}