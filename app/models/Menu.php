<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    protected $table = "menus";

    static function findStruture($value)
    {
        $menu = Menu::join('pages', 'menus.id', '=', 'pages.fk_menu')
            ->join('permissions', 'permissions.id', '=', 'pages.fk_permission')
            ->selectRaw("menus.name, menus.position, icon, pages.name AS name_page, path, SPLIT_PART(pages.path, '/', 1) AS menu_heading")
            ->where('value', '=', $value)
            ->where('menus.active', 1)
            ->where('pages.active', 1)
            ->where('permissions.active', 1)
            ->orderBy('position')
            ->orderBy('pages.name')
            ->orderBy('menus.created_at')
            ->get();

        return $menu;
    }
}
