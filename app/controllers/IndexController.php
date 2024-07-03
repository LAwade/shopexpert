<?php

namespace app\controllers;

use app\models\User;
use app\core\Controller;
use Exception;
use PDOException;

class IndexController extends Controller
{

    public function index(){
        redirect('shop/show');
    }

    public function login()
    {
        session()->destroy();
        $data = is_postback();

        try{
            if ($data && $data['password'] && $data['email']) {
                $user = User::findByMail($data['email']);
    
                if (!$user->active && $user->email) {
                    $this->message()->info("Perform account authentication, check your e-mail to validate!");
                } else {
                    if (password_verify($data['password'], $user->password)) {
                        session()->set(CONF_SESSION_LOGIN, $user);
                        $this->message()->success("Login success!");
                    } else {
                        $this->message()->warning("E-mail or Password invalid!");
                    }
                }
            }
    
            if (session()->has(CONF_SESSION_LOGIN)) {
                redirect('shop/show');
            }
        } catch (PDOException $p) {
            logger("database_login")->error($p->getMessage());
            $this->message()->danger("Não foi possível realizar a ação!")->flash();
        } catch (Exception $e) {
            $this->message()->danger($e->getMessage())->flash();
        }

        $this->view('login');
    }

    public function logoff()
    {
        if (session()->has(CONF_SESSION_LOGIN)) {
            session()->destroy();
        }
        redirect('login');
    }
}
