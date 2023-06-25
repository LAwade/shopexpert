<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = "pages";

    public function findAllConfig()
    {
        $pages = Page::join('permissions', 'permissions.id', '=', 'pages.fk_permission')
            ->join('menus', 'menus.id', '=', 'pages.fk_menu')
            ->select('pages.id', 'path', 'pages.name', 'permissions.name as access', 'pages.active')
            ->orderBy('pages.id')
            ->get();
        return $pages;
    }
}
