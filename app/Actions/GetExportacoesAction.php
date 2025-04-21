<?php

namespace App\Actions;

use App\Dtos\BaseDto;
use Twilio\Rest\Client;
use App\Models\{ Exportacao, Ncm, Unidade, Pais, Via, Urf };

class GetExportacoesDto extends BaseDto
{
    protected string|null $competencia=null;
    protected bool $paginado=false;
    protected string|null $ncm=null;
    protected string|null $unidade=null;
    protected string|null $pais=null;
    protected string|null $uf=null;
    protected string|null $via=null;
    protected string|null $urf=null;
}
class GetExportacoesAction extends BaseAction
{
    protected array $validationRules = [
        'competencia' => 'nullable|date_format:Y-m',
        'ncm' => 'nullable|numeric|exists:ncms,codigo',
        'unidade' => 'nullable|string|exists:unidades,nome',
        'pais' => 'nullable|string|exists:paises,nome',
        'uf' => 'nullable|string|size:2',
        'via' => 'nullable|string|exists:vias,nome',
        'urf' => 'nullable|string|exists:urfs,nome',
        'paginado' => 'boolean',
    ];

    public function __invoke()
    {
        dd('aaa');
    }

    public function handle(GetExportacoesDto $data)
    {
        $this->validateData($data);

        $exportacoes = Exportacao::query();

        if ($data->competencia) {
            list($ano, $mes) = explode('-', $data->competencia);
            $exportacoes
                ->where('ano', $ano)
                ->where('mes', $mes);
        }

        if ($data->ncm) $exportacoes->where('ncm_id', Ncm::where('codigo', $data->ncm)->firstOrFail()->id);

        if ($data->unidade) $exportacoes->where('unidade_id', Unidade::where('nome', $data->unidade)->firstOrFail()->id);

        if ($data->pais) $exportacoes->where('pais_id', Pais::where('nome', $data->pais)->firstOrFail()->id);

        if ($data->uf) $exportacoes->where('uf', strtoupper($data->uf));

        if ($data->via) $exportacoes->where('via_id', Via::where('nome', $data->via)->firstOrFail()->id);

        if ($data->urf) $exportacoes->where('urf_id', Urf::where('nome', $data->urf)->firstOrFail()->id);

        return $data->paginado ? $exportacoes->paginate() : $exportacoes->get();
    }
}
