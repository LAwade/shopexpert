<?php

namespace app\repository;

use app\core\Repository;
use app\models\Page;

class PageRepository extends Repository{

    function __construct()
    {
        $this->table();
    }

    private function table(){
        $this->table = Page::TABLE;
    }
    
    function create(Page $data, ?int $id = null)
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
        $query = "SELECT * FROM {$this->table} ORDER BY position, name";
        return $this->read($query)->fetchAll();
    }

    public function findStruture($value) {
        $query = "SELECT * FROM {$this->table} a "
                . "INNER JOIN permissions b ON b.id = a.access_id_permission "
                . "INNER JOIN menus c ON c.id_menu = a.id_menu "
                . "ORDER BY id_page";
        return $this->read($query)->fetchAll();
    }

    public function findAllConfig() {
        $query = "SELECT a.id, path, a.name, b.name as access, a.active 
                FROM {$this->table} a 
                INNER JOIN permissions b ON b.id = a.access_id_permission 
                INNER JOIN menus c ON c.id = a.id_menu 
                ORDER BY a.id";
        return $this->read($query)->fetchAll();
    }
}