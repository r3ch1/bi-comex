<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vias', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('nome');
            $table->timestamps();
        });

        $vias = [
            0 => 'VIA NAO DECLARADA',
            1 => 'MARITIMA',
            2 => 'FLUVIAL',
            3 => 'LACUSTRE',
            4 => 'AEREA',
            5 => 'POSTAL',
            6 => 'FERROVIARIA',
            7 => 'RODOVIARIA',
            8 => 'CONDUTO/REDE DE TRANSMISSAO',
            9 => 'MEIOS PROPRIOS',
            10 => 'ENTRADA/SAIDA FICTA',
            11 => 'COURIER',
            12 => 'EM MAOS',
            13 => 'POR REBOQUE',
            14 => 'DUTOS',
            15 => 'VICINAL FRONTEIRICO',
            99 => 'VIA DESCONHECIDA',
        ];

        foreach ($vias as $id => $via) {
            DB::table('vias')->insert([
                'codigo' => $id,
                'nome' => ucfirst(strtolower($via)),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vias');
    }
};
