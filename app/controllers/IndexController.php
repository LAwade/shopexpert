<?php

namespace app\controllers;

use app\models\User;
use app\core\Controller;

class IndexController extends Controller
{

    function __construct()
    {
    }

    public function index($hash = null)
    {
        $data = is_postback();

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
            redirect('home/index');
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
