<?php

namespace app\models;

use Exception;
use app\core\Model;
use app\interface\IModel;

class Permission extends Model implements IModel{

    final public const TABLE = "permissions";

    public function __construct(
        string $name,   
        int $value,
        ?int $active
    )
    {
        try{
            $this->setName($name);
            $this->setValue($value);
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
        $this->name = mb_strtoupper($name);
    }

    private function setValue($value){
        if ($value < 1 || $value > 100) {
            throw new Exception("Minimum allowance value must be 1 and the maximum 100.");
        }
        $this->value = $value;
    }

    private function setActive($active){
        if(!$active){
            $this->active = 0;
        } else {
            $this->active = 1;
        }
    }
}
