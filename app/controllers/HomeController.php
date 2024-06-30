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

    public function shop()
    {
        $this->load('home/index');
        $this->view('template');
    }

}
