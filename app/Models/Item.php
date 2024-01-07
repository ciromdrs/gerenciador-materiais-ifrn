<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    /**
     * Nome da tabela no banco.
     *
     * @var string
     */
    protected $table = 'itens';

    protected $fillable=[
        'estado_conservacao',
        'disponibilidade',
        'local_id',
        'material_id',
        'foto',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    
    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function emprestimos(): BelongsToMany
    {
        return $this->belongsToMany(Emprestimo::class);
    }

    public function arquivo()
    {
        return $this->hasOne(Arquivo::class);
    }


}
