<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;
use Exception;

class HomeController extends Controller
{

    function __construct()
    {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
    }

    public function index()
    {
        $this->load('home/index');
        $this->view('template');
    }

    public function changepassword()
    {
        $input = is_postback();
        try {
            if(!$input){
                throw new Exception();
            }

            if ($input['password'] != $input['repassword']) {
                throw new Exception("Senhas não conferem!");
            }

            $password = hash_password($input['password']);
            if (!$password) {
                throw new Exception('Senha de possuir 5 ou mais letras.');
            }

            $user = User::find(session()->data(CONF_SESSION_LOGIN)->id);
            $user->password = $password;

            if ($user->save()) {
                $this->message()->success("Sua senha foi atualizada!")->flash();
            } else {
                throw new Exception("Não foi possível atualizar a sua senha!");
            }
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $this->load('home/changepassword');
        $this->view('template');
    }
}
