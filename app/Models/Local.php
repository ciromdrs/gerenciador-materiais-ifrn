<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Local extends Model
{
    use HasFactory;

    /**
     * Nome da tabela no banco.
     *
     * @var string
     */
    protected $table = 'locais';

    protected $fillable=[
        'nome'
    ];


    public function itens(): HasMany
    {
        return $this->hasMany(Item::class);
    }

}
