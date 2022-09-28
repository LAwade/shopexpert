<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Menu;
use app\models\Page;
use app\models\Permission;
use app\repository\MenuRepository;
use app\repository\PageRepository;
use app\repository\PermissionRepository;
use app\repository\UserRepository;

class AdminController extends Controller {

    private $user;
    private $page;
    private $menu;
    private $permission;

    function __construct() {
        if (!session()->data(CONF_SESSION_LOGIN)) {
            redirect('login');
        }
        $this->user = new UserRepository();
        $this->menu = new MenuRepository();
        $this->page = new PageRepository();
        $this->permission = new PermissionRepository();

    }

    public function index() {

    }
    
    public function menu($action = null, $id = null) {
        $input = is_postback();

        if (isset($input['exec'])) {
            $menu = new Menu(
                $input['name_menu'],
                $input['icon_menu'],
                $input['position_menu'],
                $input['active_menu'] ?? 0
            );

            $res = $this->menu->create($menu, $id);
            if ($res && $action != 'delete') {
                $this->message()->success($menu->callback())->flash();
            } else {
                $this->message()->danger($menu->callback())->flash();
            }
        }

        if ($action == 'delete' && $this->menu->delete($id)) {
            $this->message()->danger("The item was successfully removed!")->flash();
        }

        if ($action == 'edit' && $id && !$input) {
            unset($action);
            $info['menu'] = $this->menu->find($id);
        }

        $info['all'] = $this->menu->findAll();

        $this->load('admin/menu', $action);
        $this->view('template', $info);
    }

    public function page($action = null, $id = null) {
        $input = is_postback();

        if ($input) {
            $page = new Page(
                $input['name_page'],
                $input['path_page'],
                $input['id_menu'],
                $input['access_id_permission'],
                $input['active_page']
            );

            $res = $this->page->create($page, $id);
            if($res){
                $this->message()->success($page->callback())->flash();
            } else {
                $this->message()->danger($page->callback())->flash();
            } 
        }

        if ($action == 'delete' && $this->page->delete($id)) {
            $this->message()->danger("The item was successfully removed!")->flash();
        }

        if ($action == 'edit' && $id && !$input) {
            unset($action);
            $info['pages'] = $this->page->find($id);
        }

        $info['permission'] = $this->permission->findAll();
        $info['menu'] = $this->menu->findAll();
        $info['all'] = $this->page->findAllConfig();

        $this->load('admin/page', $action);
        $this->view('template', $info);
    }
    
}