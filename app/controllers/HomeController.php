<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class HomeController extends Controller {

    function __construct() {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
    }

    public function index() {
        $this->load('home/index');
        $this->view('template');
    }

    public function changepassword() {
        $input = is_postback();
        if ($input) {
            if ($input['password'] == $input['repassword']) {
                $user = User::find(session()->data(CONF_SESSION_LOGIN)->id);
                $user->password = $input['password'];
                
                if ($user->save()) {
                    $this->message()->success("Your password updated!")->flash();
                } else {
                    $this->message()->danger("Couldn't change password!")->flash();
                }
            } else {
                $this->message()->danger("The passwords are different!")->flash();
            }
        }
        $this->load('home/changepassword');
        $this->view('template');
    }
}