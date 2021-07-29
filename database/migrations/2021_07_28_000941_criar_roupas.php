<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarRoupas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Roupas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->string('cor');
            $table->string('tamanho');
            $table->float('valor', 10, 2);
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
        Schema::dropIfExists('Roupas');
    }
}
