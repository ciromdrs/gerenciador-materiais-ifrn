<?php

namespace App\Models;

use App\Enums\EstadoConservacaoEnum;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'estado_conservacao',
        'local_id',
    ];

    protected $table = 'materiais';

    // TODO: Descomentar abaixo
    // Isto serve para transformar o Enum em string
    // protected $casts = [
    //     'estado_conservacao' => EstadoConservacaoEnum::class
    // ];

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }

    public function local(): HasOne
    {
        return $this->hasOne(Local::class);
    }

    // TODO: Renomear para foto
    public function arquivo()
    {
        return $this->hasOne(Arquivo::class);
    }
}
