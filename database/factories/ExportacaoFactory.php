<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Ncm, Unidade, Pais, Via, Urf};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exportacao>
 */
class ExportacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'ano' => '202'.rand(1, 5),
            'mes' => rand(1, 12),
            'ncm_id' => Ncm::inRandomOrder()->first()->id,
            'unidade_id' => Unidade::inRandomOrder()->first()->id,
            'pais_id' => Pais::inRandomOrder()->first()->id,
            'uf' => [
                'RO',
                'AC',
                'AM',
                'RR',
                'PA',
                'AP',
                'TO',
                'MA',
                'PI',
                'CE',
                'RN',
                'PB',
                'PE',
                'AL',
                'SE',
                'BA',
                'MG',
                'ES',
                'RJ',
                'SP',
                'PR',
                'SC',
                'RS',
                'MS',
                'MT',
                'GO',
                'DF',
            ][rand(0,26)],
            'via_id' => Via::inRandomOrder()->first()->id,
            'urf_id' => Urf::inRandomOrder()->first()->id,
            'qt_estat' => rand(10, 9999999),
            'kg_liquido' => rand(10, 99999),
            'vl_fob' => rand(10, 99999),
        ];
    }
}
