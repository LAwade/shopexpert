<?php

namespace app\core;

use app\core\Message;

abstract class Controller {

    private $message;
    private $view;

    abstract function index();

    public function view($page, $data = array()) {
        $view = $this->view;
        extract($data);
        include CONF_DIR_TEMPLATE . $page . CONF_EXTESAO_TEMPLATE;
    }

    protected function load($view, $action = null) {
        $this->view = $view;
        if ($action) {
            redirect($this->view);
        }
    }

    public function message(): Message {
        if (!$this->message) {
            $message = new Message();
            return $this->message = $message;
        }
        return $this->message;
    }
}

?>