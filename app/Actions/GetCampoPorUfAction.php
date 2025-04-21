<?php

namespace App\Actions;

use App\Dtos\BaseDto;
use Twilio\Rest\Client;
use App\Models\{ Exportacao, Ncm, Unidade, Pais, Via, Urf };
use Carbon\Carbon;

class GetCampoPorUfDto extends BaseDto
{
    protected string|null $uf=null;
    protected string|null $campo=null;
}

class GetCampoPorUfAction extends BaseAction
{
    protected array $validationRules = [
        'uf' => 'required|string',
        'campo' => 'required|string',
    ];

    protected function nomeMes($numero)
    {
        return [
            1 => 'janeiro',
            2 => 'fevereiro',
            3 => 'março',
            4 => 'abril',
            5 => 'maio',
            6 => 'junho',
            7 => 'julho',
            8 => 'agosto',
            9 => 'setembro',
            10 => 'outubro',
            11 => 'novembro',
            12 => 'dezembro',
        ][$numero];
    }

    public function handle(GetCampoPorUfDto $data)
    {
        $this->validateData($data);

        $exportacoes = Exportacao::select($data->campo)
            ->where('uf', strtoupper($data->uf))
            ->groupBy($data->campo)
            ->orderBy($data->campo)
            ->get();

        if ($data->campo === 'mes') {
            $retorno = [];
            foreach ($exportacoes as $exportacao) {
                $retorno[$exportacao->mes] = $this->nomeMes($exportacao->mes);
            }
            return $retorno;
        }

        return $exportacoes->pluck($data->campo);
    }
}
