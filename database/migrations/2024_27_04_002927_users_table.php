<?php

namespace Database\Migrations;

use Framework\QueryBuilder\Blueprint;
use Framework\QueryBuilder\Migration;
use Framework\QueryBuilder\Schema;

class UsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $attribute) {
            $attribute->id();
            $attribute->varchar('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
