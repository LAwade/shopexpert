<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class AdminController extends Controller {

    function __construct() {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
    }

    public function index() {
        $this->load('home/index');
        $this->view('template');
    }

    public function page($action = null, $id = null) {
        $input = is_postback();

        if($id){
            $page = Page::find($id);
        } else {
            $page = new Page();
        }

        if ($input) {
            $page->name = $input['name_page'];
            $page->path = $input['path_page'];
            $page->active = $input['active_page'];

            if($page->save()){
                $this->message()->success("Page is saved")->flash();
            } else {
                $this->message()->danger("Page isn't created!")->flash();
            } 
        }

        if ($action == 'delete' && $page) {
            $page->delete();
            $this->message()->danger("The item was successfully removed!")->flash();
        }

        $info['all'] = Page::findAllConfig();
        $info['pages'] = $page;
        $this->load('admin/page', $action);
        $this->view('template', $info);
    }
}