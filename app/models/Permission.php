<?php

namespace app\models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";

    public function findByName($name)
    {
        return Permission::where('name', $name)->get();
    }

    public function findPermissionByUser($id)
    {
        $pages = Permission::join('permissions_users', 'permissions.id', '=', 'permissions_users.fk_permission')
            ->join('users', 'users.id', '=', 'permissions_users.fk_user')
            ->select('users.name', 'users.value')
            ->where('users.id', $id)
            ->where('permissions', 1)
            ->first();
        return $pages;
    }

    public function findPermissionUserPage($id, $path)
    {
        $perm = Permission::select('value')->find($id);
        return Permission::join('pages', 'pages.fk_permission', '=', 'permission.id')
            ->where('path', $path)
            ->where('value', '<=',  $perm)
            ->first();
    }
}
