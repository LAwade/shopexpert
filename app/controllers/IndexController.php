<?php

namespace app\controllers;

use app\models\User;
use app\core\Controller;
use app\core\SimplesMail;
use app\models\PermissionUser;
use app\repository\MenuRepository;
use app\repository\PermissionRepository;
use app\repository\PermissionUserRepository;
use app\repository\UserRepository;

class IndexController extends Controller {

    private $user;
    private $simplesMail;
    private $menu;
    private $permission;

    function __construct() {
        $this->user = new UserRepository();
        $this->menu = new MenuRepository();
        $this->permission = new PermissionRepository();
        $this->permission_user = new PermissionUserRepository();
        $this->simplesMail = new SimplesMail(CONF_MAIL_USER, CONF_MAIL_PASSWD);
    }

    public function index($hash = null) {
        $data = is_postback();

        if ($data['password'] && $data['email']) {
            $user = $this->user->findByMail($data['email']);
            if (!$user->active && $user->email) {
                $this->message()->info("Perform account authentication, check your e-mail to validate!");
            } else {
                if (password_verify($data['password'], $user->password)) {
                    session()->set(CONF_SESSION_LOGIN, $user);
                    session()->set(CONF_SESSION_MENU, $this->menu->findStruture($this->permission->findPermissionByUser($user->id)->value));
                    $this->message()->success("Login success!");
                } else {
                    $this->message()->warning("E-mail or Password invalid!");
                }
            }
        }

        if (session()->has(CONF_SESSION_LOGIN)) {
            redirect('home/index');
        }  

        $this->view('login');
    }

    public function createaccount() {
        $data = is_postback();
        if ($data) {

            if($data['password'] != $data['repassword']){
                $this->message()->danger("Password do not match!")->flash();
                return $this->view('createaccount');
            }

            $user = new User(
                $data['name'],
                $data['mail'], 
                $data['password'],
                1
            );

            if ($id_user = $this->user->create($user)) {
                $permission_user = new PermissionUser(
                    CONF_DEFAULT_PERMISSION,
                    $id_user
                );

                if($this->permission_user->create($permission_user)){
                    $this->message()->info("Welcome to " . CONF_NAME_SYSTEM . "!")->flash();
                } else {
                    $this->user->delete($id_user);
                    $this->message()->warning($permission_user->callback())->flash();
                }
            } else {
                $this->message()->warning($user->callback())->flash();
            }
        }
        $this->view('createaccount');
    }

    // public function forgotpassword() {
    //     $data = is_postback();
    //     if ($data['mail']) {
    //         if ($info = $this->user->findByMail($data['mail'])) {
    //             $hash = generateAccountHash($info->id_user);
    //             session()->set('change_password', ['hash' => $hash, 'id_user' => $info->id_user]);
    //             $this->simplesMail->setSubject('[ '. CONF_NAME_SYSTEM. ' ] - Recover account!');
                
    //             $template = array(
    //                 "{USER}" => $info->name,
    //                 "{LINK}" => CONF_URL_SITE . 'index/changepassword/' . $hash);

    //             $this->simplesMail->pathBodyMail(CONF_MAILING_TEMP_RECUPERAR, $template);

    //             if ($this->simplesMail->mailing($data['mail'])) {
    //                 $this->message()->success("link has been sent to your email!")->flash();
    //             } else {
    //                 $this->message()->danger("Could not send password recovery in your email!")->flash();
    //             }
    //         } else {
    //             $this->message()->warning($this->user->callback())->flash();
    //         }
    //     }
    //     $this->view('forgotpassword');
    // }

    // public function changepassword($hash = null) {
    //     $data = is_postback();
    //     if ($hash == session()->data('change_password')->hash) {
    //         $id = session()->data('change_password')->id_user;
    //         if ($data['executar']) {
    //             if ($data['password'] == $data['repassword']) {
    //                 $info = $this->user->findById($id);
    //                 $user = $this->user->bootstrap($info->name, $info->mail, $data['password'], $info->fk_id_company, 'true');
    //                 if ($user && $this->user->save($info->id_user)) {
    //                     $this->message()->success("Your password updated!");
    //                     session()->unset('change_password');
    //                 } else {
    //                     $this->message()->warning($this->user->callback())->flash();
    //                 }
    //             } else {
    //                 $this->message()->warning("Passwords are not the same!")->flash();
    //             }
    //         }
    //     } else {
    //         $this->message()->danger("The change link has expired! Perform the password recovery steps again.")->flash();
    //     }
    //     $this->view('changepassword');
    // }

    public function logoff() {
        if (session()->has(CONF_SESSION_LOGIN)) {
            session()->destroy();
        }
        redirect('login');
    }
}
