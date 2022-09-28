<?php

namespace app\models;

use Exception;
use app\core\Model;
use app\interface\IModel;

class PermissionUser extends Model implements IModel{

    final public const TABLE = "permissions_client";

    public function __construct(
        int $permission,   
        int $user
    )
    {
        try{
            $this->setPermission($permission);
            $this->setUser($user);
            $this->callback("Your action is Success!");
        } catch(Exception $ex){
            $this->callback($ex->getMessage());
        }
    }

    function toArray(): array{
        return filter_data($this);
    }

    private function setPermission($permission){
        if (!$permission) {
            throw new Exception("Please complete field ID permission!");
        }
        $this->id_permission = $permission;
    }

    private function setUser($user){
        if (!$user) {
            throw new Exception("Please complete field ID user!");
        }
        $this->id_client = $user;
    }
}
