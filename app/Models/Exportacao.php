<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exportacao extends Model
{
    /** @use HasFactory<\Database\Factories\ExportacaoFactory> */
    use HasFactory;
    protected $table = 'exportacoes';

    public function ncm(): HasOne
    {
        return $this->hasOne(Ncm::class);
    }

    public function unidade(): HasOne
    {
        return $this->hasOne(Unidade::class);
    }

    public function pais(): HasOne
    {
        return $this->hasOne(Pais::class);
    }

    public function via(): HasOne
    {
        return $this->hasOne(Via::class);
    }

    public function urf(): HasOne
    {
        return $this->hasOne(Urf::class);
    }
}
