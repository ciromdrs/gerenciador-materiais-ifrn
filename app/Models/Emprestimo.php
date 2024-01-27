<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable = [
        // Servidor que entregou os materiais
        'usuario_que_emprestou',
        // Servidor que recebeu de volta
        'usuario_que_recebeu',
        // Aluno ou servidor que foi devolver
        'usuario_que_devolveu',
    ];

    public function materiais(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }
}
