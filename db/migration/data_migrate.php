<?php

require __DIR__ . '/../../config/includes.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('companies', function ($table) {
    $table->increments('id');
    $table->string('name', 250);
    $table->string('slogan', 250);
    $table->string('token', 250);
    $table->integer('active')->default(1);
    $table->timestamps();
});

Capsule::schema()->create('users', function ($table) {
    $table->increments('id');
    $table->string('name', 250);
    $table->string('email', 250);
    $table->string('password', 250);
    $table->integer('active')->default(1);
    $table->timestamps('last_access');
    $table->timestamps();
});

Capsule::schema()->create('menus', function ($table) {
    $table->increments('id');
    $table->string('name', 50);
    $table->string('icon', 250);
    $table->integer('position');
    $table->integer('active')->default(1);
    $table->timestamps();
});

Capsule::schema()->create('pages', function ($table) {
    $table->increments('id');
    $table->string('name', 250);
    $table->string('path', 250);
    $table->integer('fk_menu');
    $table->integer('fk_permission');
    $table->integer('active')->default(1);
    $table->timestamps();
});

Capsule::schema()->create('permissions', function ($table) {
    $table->increments('id');
    $table->string('name', 250);
    $table->integer('value');
    $table->integer('active')->default(1);
    $table->timestamps();
});

Capsule::schema()->create('permissions_users', function ($table) {
    $table->increments('id');
    $table->integer('fk_permission');
    $table->integer('fk_user');
    $table->integer('active')->default(1);
    $table->timestamps();
});
