<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\models\User;
use Exception;

class AdminController extends Controller
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
}
