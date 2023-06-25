<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menus";

    public function findStruture($value)
    {
        $menu = Menu::join('pages', 'menu.id', '=', 'pages.fk_menu')
            ->join('permissions', 'permissions.id', '=', 'pages.fk_permission')
            ->select('menu.name', 'postion', 'icon', 'pages.name AS name_page', 'path', "split_part(path, '/', 1) AS menu_heading")
            ->where('value', '=', $value)
            ->where('menu.active', 1)
            ->where('pages.active', 1)
            ->where('permissions.active', 1)
            ->orderBy('position')
            ->orderBy('pages.name')
            ->orderBy('menu.created_at')
            ->get();
        return $menu;
    }
}
