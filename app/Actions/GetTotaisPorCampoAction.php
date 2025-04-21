<?php

namespace App\Actions;

use App\Dtos\BaseDto;
use Twilio\Rest\Client;
use App\Models\{ Exportacao };
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetTotaisPorCampoDto extends BaseDto
{
    protected string|null $uf=null;
    protected string|null $mes=null;
    protected string|null $ano=null;
    protected string|null $totalizador=null;
    protected string|null $campo=null;
}

class GetTotaisPorCampoAction extends BaseAction
{
    protected array $validationRules = [
        'uf' => 'required|string',
        'mes' => 'required|string',
        'ano' => 'required|string',
        'totalizador' => 'required|string',
        'campo' => 'required|string',
    ];

    public function handle(GetTotaisPorCampoDto $data)
    {
        $this->validateData($data);

        return Exportacao::select([
            $data->campo,
            DB::raw('SUM('.$data->totalizador.') as sumed_'.$data->totalizador)
        ])
        ->with(str_replace('_id', '', $data->campo))
        ->where('uf', $data->uf)
        ->where(function($query) use($data){
            $query->where('mes', $data->mes)
            ->where('ano', $data->ano);
        })
        ->groupBy($data->campo)
        ->get();
    }
}
