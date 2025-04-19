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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('nome');
            $table->timestamps();
        });

        $unidades = [
            10 => 'QUILOGRAMA LIQUIDO',
11 => 'NUMERO (UNIDADE)',
12 => 'MILHEIRO',
13 => 'PARES',
14 => 'METRO',
15 => 'METRO QUADRADO',
16 => 'METRO CUBICO',
17 => 'LITRO',
18 => 'MIL QUILOWATT HORA',
19 => 'QUILATE',
20 => 'DUZIA',
21 => 'TONELADA METRICA LIQUIDA',
22 => 'GRAMA LIQUIDO',
23 => 'BILHOES DE UNIDADES INTERNACIONAIS',
24 => 'QUILOGRAMA BRUTO',
        ];

        foreach ($unidades as $id => $nome) {
            DB::table('unidades')->insert([
                'codigo' => $id,
                'nome' => $nome,
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
        Schema::dropIfExists('unidades');
    }
};
