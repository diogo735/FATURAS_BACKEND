<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movimento_id',
        'tipo_documento',
        'numero_fatura',
        'data_fatura',
        'nif_emitente',
        'codigo_ATCUD',
        'nome_empresa',
        'nif_cliente',
        'descricao',
        'total_iva',
        'total_final',
        'imagem_fatura',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movimento()
    {
        return $this->belongsTo(Movimento::class);
    }
}

