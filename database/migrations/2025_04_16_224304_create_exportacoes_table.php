<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exportacoes', function (Blueprint $table) {
            $table->id();
            $table->integer('ano');
            $table->integer('mes');
            $table->unsignedBigInteger('ncm_id');
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('pais_id');
            $table->string('uf', 2);
            $table->unsignedBigInteger('via_id');
            $table->unsignedBigInteger('urf_id');
            $table->integer('qt_estat');
            $table->integer('kg_liquido');
            $table->integer('vl_fob');
            $table->timestamps();

            $table->foreign('ncm_id')->references('id')->on('ncms');
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('via_id')->references('id')->on('vias');
            $table->foreign('urf_id')->references('id')->on('urfs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exportacoes');
    }
};
