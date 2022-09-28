<?php

namespace app\models;

use Exception;
use app\core\Model;
use app\interface\IModel;

class Menu extends Model implements IModel{

    final public const TABLE = "menus";

    public function __construct(
        string $name,   
        string $icon,
        int $position,
        ?int $active 
    )
    {
        try{
            $this->setName($name);
            $this->setIcon($icon);
            $this->setPosition($position);
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
        if (strlen($name) < 3 || strlen($name) > 50) {
            throw new Exception("Name must contain 3 to 50 caracteres. Has: " . strlen($name));
        }
        $this->name = ucwords($name);
    }

    private function setIcon($icon){
        if (strlen($icon) < 3 || strlen($icon) > 250) {
            throw new Exception("Icon must contain 3 to 250 caracteres. Has: " . strlen($icon));
        }
        $this->icon = $icon;
    }

    private function setPosition($position){
        if ($position < 0) {
            throw new Exception("Minimum allowance value must be 0.");
        }
        $this->position = $position;
    }

    private function setActive($active){
        if(!$active){
            $this->active = 0;
        } else {
            $this->active = 1;
        }
    }
}
