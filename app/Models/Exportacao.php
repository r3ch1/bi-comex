<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exportacao extends Model
{
    /** @use HasFactory<\Database\Factories\ExportacaoFactory> */
    use HasFactory;
    protected $table = 'exportacoes';

    public function ncm(): BelongsTo
    {
        return $this->belongsTo(Ncm::class);
    }

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class);
    }

    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class);
    }

    public function via(): BelongsTo
    {
        return $this->belongsTo(Via::class);
    }

    public function urf(): BelongsTo
    {
        return $this->belongsTo(Urf::class);
    }
}
