<?php

namespace App\Http\Controllers;

use App\Actions\{GetCampoPorUfDto, GetCampoPorUfAction};

class GetCampoPorUfController extends Controller {
    public function __invoke($uf, $campo, GetCampoPorUfAction $action, GetCampoPorUfDto $dto)
    {
        try {
            return ['data' => $action->handle($dto->fromArray([...request()->all(), ...['uf' => $uf, 'campo' => $campo]]))];
        } catch (\Throwable $e) {
            dd($e->getMessage(), $e->getLine(), $e->getFile());
        }
    }
}
