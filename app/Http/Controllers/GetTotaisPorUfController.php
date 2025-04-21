<?php

namespace App\Http\Controllers;

use App\Actions\{GetTotaisPorUfDto, GetTotaisPorUfAction};
use App\Http\Resources\GetTotaisPorUfResource;

class GetTotaisPorUfController extends Controller {
    public function __invoke($uf, GetTotaisPorUfAction $action, GetTotaisPorUfDto $dto)
    {
        try {
            return ['data' => $action->handle($dto->fromArray([...request()->all(), ...['uf' => $uf]]))];
        } catch (\Throwable $e) {
            dd($e->getMessage(), $e->getLine(), $e->getFile());
        }
    }
}
