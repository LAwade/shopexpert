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

    public function index($hash = null)
    {
        $this->view('login');
    }

    public function show()
    {
        $this->load('shop/show');
        $this->view('template');
    }
}
