<?php

namespace app\models;

use Exception;
use app\core\Model;
use app\interface\IModel;

class Page extends Model implements IModel{

    final public const TABLE = "pages";

    public function __construct(
        string $name,   
        string $path,
        int $menu,
        int $access,
        ?int $active
    )
    {
        try{
            $this->setName($name);
            $this->setPath($path);
            $this->setMenu($menu);
            $this->setAccess($access);
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
        if (strlen($name) < 3 || strlen($name) > 250) {
            throw new Exception("Name must contain 3 to 250 caracteres. Has: " . strlen($name));
        }
        $this->name = ucwords($name);
    }

    private function setPath($path){
        if (strlen($path) < 3 || strlen($path) > 250) {
            throw new Exception("Path must contain 3 to 250 caracteres. Has: " . strlen($path));
        }
        $this->path = $path;
    }

    private function setMenu($menu){
        if (!$menu) {
            throw new Exception("Menu is invalid!");
        }
        $this->id_menu = $menu;
    }

    private function setAccess($access){
        if (!$access) {
            throw new Exception("The value access is invalid!");
        }
        $this->access_id_permission = $access;
    }

    private function setActive($active = null){
        if(!$active){
            $this->active = 0;
        } else {
            $this->active = 1;
        }
    }
}
