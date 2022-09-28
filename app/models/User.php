<?php

namespace app\models;

use Exception;
use app\core\Model;
use app\interface\IModel;

class User extends Model implements IModel{

    final public const TABLE = "clients";

    public function __construct(
        string $name,   
        string $email,
        string $password,
        ?int $active
    )
    {
        try{
            $this->setName($name);
            $this->setMail($email);
            $this->setPassword($password);
            $this->setActive($active);
            $this->callback("Your action is Success!");
        } catch(Exception $ex){
            $this->callback($ex->getMessage());
        }
    }

    function toArray(): array{
        return filter_data($this);
    }

    private function setName($name){
        if (strlen($name) < 5 || strlen($name) > 150) {
            throw new Exception("Name must contain 5 to 150 caracteres. Has: " . strlen($name));
        }
        $this->name = mb_strtoupper(str_juststr($name));
    }

    private function setMail($email){
        if (strlen($email) < 7 || strlen($email) > 150) {
            throw new Exception("Mail must contain 7 to 150 caracteres. Has: " . strlen($email));
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Mail invalid!");
        }
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function setPassword($password){
        if (password_get_info($password)['algoName'] == 'bcrypt') {
            $this->password = $password;
        } else {
            if (strlen($password) < 5 || strlen($password) > 20) {
                throw new Exception("Password must contain 5 to 20 caracteres. Has: " . strlen($password));
            }
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    private function setActive($active){
        if(!$active){
            $this->active = 0;
        } else {
            $this->active = 1;
        }
    }
}
