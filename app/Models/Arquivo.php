<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Arquivo extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_id',
        'caminho',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
