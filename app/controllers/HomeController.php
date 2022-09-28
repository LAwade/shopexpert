<?php

namespace app\controllers;

use app\core\Controller;
use app\models\user;
use app\repository\UserRepository;

class HomeController extends Controller {

    private $user;

    function __construct() {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
        $this->user = new UserRepository();
    }

    public function index() {
        
        $this->load('home/index');
        $this->view('template');
    }

    public function changepassword() {
        $input = is_postback();
        if ($input) {
            if ($input['password'] == $input['repassword']) {
                $data = $this->user->find(session()->data(CONF_SESSION_LOGIN)->id);
                $user = new User(
                    $data->name,
                    $data->email,
                    $input['password'],
                    $data->active,
                );
                
                if ($this->user->create($user, $data->id)) {
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