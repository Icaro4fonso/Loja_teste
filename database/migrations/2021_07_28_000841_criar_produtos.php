<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('id_roupa');
            $table->float('id_estampa');
            $table->string('SKU');
            $table->float('valor');
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
        Schema::dropIfExists('Produtos');
    }
}
