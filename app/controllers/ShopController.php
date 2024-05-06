<?php

namespace app\controllers;

use app\models\User;
use app\core\Controller;
use app\core\SimplesMail;
use app\models\Menu;
use app\models\Permission;
use app\models\PermissionUser;
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
