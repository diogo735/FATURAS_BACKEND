<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_movimento_id',
        'nome_cat',
        'img_cat',
        'cor_cat',
    ];

    public function tipoMovimento()
    {
        return $this->belongsTo(TipoMovimento::class);
    }

    public function subCategorias()
    {
        return $this->hasMany(SubCategoria::class);
    }
}
