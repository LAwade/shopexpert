<?php

namespace app\repository;

use app\core\Repository;
use app\models\Permission;
use app\models\Page;
use app\models\User;

class PermissionRepository extends Repository{

    function __construct()
    {
        $this->table();
    }

    private function table(){
        $this->table = Permission::TABLE;
    }
    
    public function create(Permission $data, ?int $id = null)
    {
        if($id){
            return $this->update($data->toArray(), ['id' => $id]);
        }
        return $this->insert($data->toArray(), $id);
    }
    
    function delete(int $id){
        return $this->remove($id);
    }
    
    function find(int $id){
        $query = "SELECT * FROM {$this->table} WHERE id = :id;";
        return $this->read($query, ['id' => $id])->fetch();
    }
    
    function findAll(){
        $query = "SELECT * FROM {$this->table} ORDER BY name";
        return $this->read($query)->fetchAll();
    }

    function findByName($name) {
        $query = "SELECT * FROM {$this->table} WHERE name = :name";
        return $this->read($query, ['name' => $name])->fetch();
    }

    function findPermissionByUser($iduser){
        $query = "SELECT c.name, c.value 
        FROM " .User::TABLE. " a
        INNER JOIN permissions_client b ON a.id = b.id_client
        INNER JOIN ".Permission::TABLE." c ON c.id = b.id_permission
        WHERE a.id = :id
        AND c.active = :active";
        return $this->read($query, ["id" => $iduser, 'active' => 1])->fetch();
    }

    function findPermissionUserPage($id, $page){
        $query = "SELECT * FROM {$this->table} a
        INNER JOIN ". Page::TABLE . " b ON b.access_id_permission = a.id
        WHERE path = :path
        AND value_permission <= (SELECT value FROM ".Permission::TABLE." WHERE id = :id) 
        AND active = 1";

        return $this->read($query, ["path" => $id, "id" => $page])->fetch();
    }
}