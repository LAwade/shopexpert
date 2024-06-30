<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    public $timestamps = false;

    static function findByMail($email)
    {
        return User::where('email', $email)->first();
    }
}
