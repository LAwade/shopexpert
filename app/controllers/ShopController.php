<?php

namespace app\controllers;

use app\models\User;
use app\core\Controller;
use Valitron\Validator;

class ShopController extends Controller
{

    function __construct()
    {
        
    }

    public function index()
    {
        $this->load('home/index');
        $this->view('template');
    }

    public function show()
    {
        $this->load('shop/show');
        $this->view('template');
    }
}
