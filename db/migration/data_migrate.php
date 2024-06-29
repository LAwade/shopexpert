<?php

require __DIR__ . '/../../config/includes.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropIfExists('users');
Capsule::schema()->create('users', function ($table) {
    $table->increments('id');
    $table->string('name', 250);
    $table->string('email', 250);
    $table->string('password', 250);
    $table->integer('active')->default(1);
    $table->timestamp('last_access');
    $table->timestamps();
});

Capsule::schema()->dropIfExists('pages');
Capsule::schema()->create('pages', function ($table) {
    $table->increments('id');
    $table->string('name', 250);
    $table->string('path', 250);
    $table->integer('active')->default(1);
    $table->timestamps();
});

