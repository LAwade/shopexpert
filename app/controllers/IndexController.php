<?php

namespace app\controllers;

use app\models\User;
use app\core\Controller;
use Valitron\Validator;

class IndexController extends Controller
{

    private $simplesMail;

    function __construct()
    {
        $this->simplesMail = new SimplesMail(CONF_MAIL_USER, CONF_MAIL_PASSWD);
    }

    public function index($hash = null)
    {
        $data = is_postback();

        if ($data['password'] && $data['email']) {
            $user = User::findByMail($data['email']);

            if (!$user->active && $user->email) {
                $this->message()->info("Perform account authentication, check your e-mail to validate!");
            } else {
                if (password_verify($data['password'], $user->password)) {
                    session()->set(CONF_SESSION_LOGIN, $user);
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

    public function createaccount()
    {
        $data = is_postback();
        $v = new Validator($data);
        
        if (!$data) {
            return $this->view('createaccount');
        }

        $v->rule('required', ['name', 'email', 'password']);
        if($v->validate() == false) {
            $errors = $v->errors();
            $menssage = [];
            foreach($errors as $e){
                $menssage[] = $e[0];
            }
            $this->message()->list_danger("Por favor, complete os campos abaixo: ", $menssage)->flash();
            return $this->view('createaccount', $data);
        }
       
        if ($data['password'] != $data['repassword']) {
            $this->message()->danger("As senhas informadas é incompatíveis")->flash();
            return $this->view('createaccount', $data);
        }

        $info = User::findByMail($data['mail']);
        if ($info) {
            $this->message()->danger("E-mail informado já foi cadastrado!")->flash();
            return $this->view('createaccount', $data);
        }

        $password = hash_password($data['password']);
        if(!$password){
            $this->message()->danger('Senha de possuir 5 ou mais letras.');
            return $this->view('createaccount', $data);
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $password;
        $user->active = 1;
        $user->last_access = date(CONF_DATE_HOUR_APP);

        if ($user->save()) {
            $this->message()->info("Seja bem-vindo a " . CONF_NAME_SYSTEM . "!")->flash();
            redirect('index/login');
        } else {
            $this->message()->warning($user->callback())->flash();
        }

        $this->view('createaccount');
    }

    public function forgotpassword()
    {
        $data = is_postback();
        if (!$data['mail']) {
            $this->message()->warning('Informe o e-mail para recuperar!')->flash();
            $this->view('forgotpassword');
            return;
        }

        $info = User::findByMail($data['mail']);

        if (!$info) {
            $this->message()->warning('E-mail informado é inválido!')->flash();
            $this->view('forgotpassword');
            return;
        }

        $hash = generateAccountHash($info->id);
        session()->set('change_password', ['hash' => $hash, 'id' => $info->id]);
        $this->simplesMail->setSubject('[ ' . CONF_NAME_SYSTEM . ' ] - RECUPERAÇÃO DE CONTA!');

        $template = array(
            "{USER}" => $info->name,
            "{LINK}" => CONF_URL_SITE . 'index/changepassword/' . $hash
        );

        $this->simplesMail->pathBodyMail(CONF_MAILING_TEMP_RECUPERAR, $template);

        if ($this->simplesMail->mailing($data['mail'])) {
            $this->message()->success("link has been sent to your email!")->flash();
        } else {
            $this->message()->danger("Could not send password recovery in your email!")->flash();
        }
        $this->view('forgotpassword');
    }

    public function changepassword($hash = null)
    {
        $data = is_postback();
        if ($hash != session()->data('change_password')->hash) {
            $this->message()->danger("The change link has expired! Perform the password recovery steps again.")->flash();
            $this->view('changepassword');
            return;
        }

        $id = session()->data('change_password')->id_user;
        if ($data['executar']) {
            if ($data['password'] != $data['repassword']) {
                $this->message()->warning("Passwords are not the same!")->flash();
                $this->view('changepassword');
                return;
            }

            $user = User::find($id);
            $user->password = $data['password'];
            if ($user->save()) {
                $this->message()->success("Your password updated!");
                session()->unset('change_password');
            } else {
                $this->message()->warning('Não foi possível alterar a senha!')->flash();
            }
        }
    }

    public function logoff()
    {
        if (session()->has(CONF_SESSION_LOGIN)) {
            session()->destroy();
        }
        redirect('login');
    }
}
