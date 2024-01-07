<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;


    protected $fillable = [

        //quem autorziou o emprestimo
        // 'usuario_que_autorizou',
        // 'user_who_authorized_id',

        //quem emprestou o item
        'usuario_que_emprestou',
        // 'user_who_delivered_id',

        //servidor que pegou de volta
        'usuario_que_recebeu',
        // 'user_who_received_id',

        //aluno aue foi devolver ao servidor
        'usuario_que_devolveu',
        // 'user_who_returned_id',
    ];

    public function itens(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }
}
