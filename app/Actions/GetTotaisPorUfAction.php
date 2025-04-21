<?php

namespace App\Actions;

use App\Dtos\BaseDto;
use Twilio\Rest\Client;
use App\Models\{ Exportacao };
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetTotaisPorUfDto extends BaseDto
{
    protected string|null $uf=null;
    protected string|null $mes=null;
    protected string|null $ano=null;
}

class GetTotaisPorUfAction extends BaseAction
{
    protected array $validationRules = [
        'uf' => 'required|string',
        'mes' => 'required|string',
        'ano' => 'required|string',
    ];

    public function handle(GetTotaisPorUfDto $data)
    {
        $this->validateData($data);

        $competenciaAnterior = Carbon::createFromFormat('Y-m', $data->ano.'-'.$data->mes)->subMonths(1)->format('Y-m');

        return Exportacao::select([
            'ano',
            'mes',
            DB::raw('SUM(vl_fob) as total_vl_fob'),
            DB::raw('SUM(kg_liquido) as total_kg_liquido'),
            DB::raw('SUM(qt_estat) as total_qt_estat '),
        ])->where(function($query) use($data){
            $query->where('mes', $data->mes)
            ->where('ano', $data->ano);
        })->orWhere(function($query) use($competenciaAnterior){
            list($ano, $mes) = explode('-', $competenciaAnterior);
            $query->where('mes', $mes)
            ->where('ano', $ano);
        })
        ->groupBy(['ano', 'mes'])
        ->get();
    }
}
