<?php

namespace app\controllers;

use app\core\Controller;
use Exception;

class ProductTaxController extends Controller
{

    function __construct()
    {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
    }

    public function index()
    {
        $this->load('producttax/index');
        $this->view('template');
    }

}
