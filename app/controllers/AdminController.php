<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Menu;
use app\models\Page;
use app\models\Permission;
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
    
    public function user($action = null, $id = null){
        $input = is_postback();

        if($id){
            $user = User::find($id);
        } else {
            $user = new User();
        }

        if($input){
            $user->name = $input['name'];
            if($input['password']){
                $user->password = password_hash($input['password'], PASSWORD_DEFAULT);
            }
            $user->email = $input['email'];
            $user->active = $input['active'];

            if($user->save()){
                $this->message()->success('CREATED SUCCESS')->flash();
            } else {
                $this->message()->danger('DELETED ERROR')->flash();
            }
        }

        if ($action == 'delete' && $id) {
            $user->active = 0;
            $user->save();
            $this->message()->danger("The item was successfully removed!")->flash();
        }

        $info['all'] = User::all();
        $info['permissions'] = Permission::all();
        $info['permission_user'] = Permission::findPermissionByUser($id);
        $info['users'] = $user;
        $this->load('admin/user', $action);
        $this->view('template', $info);
    }

    public function permission($action = null, $id = null){
        $input = is_postback();

        if($id){
            $permission = Permission::find($id);
            $info['permission'] = $permission;
        } else {
            $permission = new Permission();
        }

        if($input){
            $permission->name = $input['name'];
            $permission->value = $input['value'];
            $permission->is_default = $input['is_default'];
            $permission->active = $input['active'];
            if ($permission->save()) {
                $this->message()->success('CREATED SUCCESS')->flash();
            } else {
                $this->message()->danger('DELETED ERROR')->flash();
            }
        }
        
        if ($action == 'delete' && $permission) {
            $permission->delete();
            $this->message()->danger("The item was successfully removed!")->flash();
        }

        $info['permissions'] = Permission::all();
        $this->load('admin/permission', $action);
        $this->view('template', $info);
    }

    public function menu($action = null, $id = null) {
        $input = is_postback();

        if($id){
            $menu = Menu::find($id);            
        } else {
            $menu = new Menu();
        }

        if ($input) {
            $menu->name = $input['name_menu'];
            $menu->icon = $input['icon_menu'];
            $menu->position = $input['position_menu'];
            $menu->active = $input['active_menu'] ?? 0;
            if ($menu->save()) {
                $this->message()->success('CREATED SUCCESS')->flash();
            } else {
                $this->message()->danger('DELETED ERROR')->flash();
            }
        }

        if ($action == 'delete' && $id) {
            $menu->delete();
            $this->message()->danger("The item was successfully removed!")->flash();
        }

        $info['menu'] = $menu;
        $info['all'] = Menu::all();
        $this->load('admin/menu', $action);
        $this->view('template', $info);
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
            $page->fk_menu = $input['id_menu'];
            $page->fk_permission = $input['access_id_permission'];
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

        $info['permission'] = Permission::all();
        $info['menu'] = Menu::all();
        $info['all'] = Page::findAllConfig();
        $info['pages'] = $page;
        $this->load('admin/page', $action);
        $this->view('template', $info);
    }
}