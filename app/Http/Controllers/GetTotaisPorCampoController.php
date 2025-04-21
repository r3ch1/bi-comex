<?php

namespace App\Http\Controllers;

use App\Actions\{GetTotaisPorCampoDto, GetTotaisPorCampoAction};

class GetTotaisPorCampoController extends Controller {
    public function __invoke($uf, $totalizador, $campo, GetTotaisPorCampoAction $action, GetTotaisPorCampoDto $dto)
    {
        try {
            return ['data' => $action->handle($dto->fromArray([...request()->all(), ...['uf' => $uf, 'campo' => $campo, 'totalizador' => $totalizador]]))];
        } catch (\Throwable $e) {
            dd($e->getMessage(), $e->getLine(), $e->getFile());
        }
    }
}
