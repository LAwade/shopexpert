<?php

namespace app\core;
use Exception;

/**
 * @departament Desenvolvedor 
 * 
 * @author Lucas Awade 
 */
class Session {

    public function __construct() {
        if (!session_id()) {
            session_start();
        }
    }

    public function __get($name) {
        if (!empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }

    public function __isset($name): bool {
        return $this->has($name);
    }

    public function all() {
        return (object) $_SESSION;
    }

    public function set(string $key, $value): Session {
        $_SESSION[$key] = (is_array($value) ? (object) $value : $value);
        return $this;
    }

    public function unset(string $key) {
        unset($_SESSION[$key]);
    }

    public function has(string $key): bool {
        return isset($_SESSION[$key]);
    }

    public function data($name) {
        if (!empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }

    public function regenerate(): Session {
        session_regenerate_id(true);
        return $this;
    }

    public function destroy(): Session {
        session_destroy();
        return $this;
    }

    public function csrf() {
        try {
            $csrf = base64_encode(random_bytes(20));
            $this->set('csrf_token', $csrf);
        } catch (Exception $ex) {
            $_SESSION['csrf_token'] = base64_encode(rand(1, 9999999));
        }
    }

    public function notify(): ?string {
        $flash = $this->data('notify');
        if ($flash) {
            $this->unset('notify');
            return $flash;
        }
        return null;
    }
    
    public function flash(){
        if($this->has('flash')){
            $flash = $this->data('flash');
            $this->unset('flash');
            return $flash;
        }
        return null;
    }
}