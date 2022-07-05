<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_user', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id')->constrained('users');
            $table->foreignID('products_id')->constrained('products');
            $table->boolean('comprado')->default(false);
            $table->integer('quantidade_comprada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_user');
    }
}
