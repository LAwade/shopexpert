<?php

namespace app\repository;

use app\core\Repository;
use app\models\Menu;

class MenuRepository extends Repository{

    function __construct()
    {
        $this->table();
    }

    private function table(){
        $this->table = Menu::TABLE;
    }
    
    public function create(Menu $data, ?int $id = null)
    {
        if($id){
            return $this->update($data->toArray(), ['id' => $id]);
        }
        return $this->insert($data->toArray());
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
        $query = "SELECT a.name, position, icon, b.name as name_page, path, split_part(path, '/', 1) AS menu_heading 
                FROM {$this->table} a 
                INNER JOIN pages b ON b.id_menu = a.id
                INNER JOIN permissions d ON d.id = b.access_id_permission
                WHERE value <= :value
                AND a.active = :active
                AND b.active = :active
                AND d.active = :active
                ORDER BY position, b.name, a.created_at";
        return $this->read($query, ['value' => $value, 'active' => 1])->fetchAll();
    }
}