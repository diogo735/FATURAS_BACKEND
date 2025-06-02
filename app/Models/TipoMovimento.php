<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimento extends Model
{
    use HasFactory;

    protected $fillable = ['nome_movimento'];

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }
}
