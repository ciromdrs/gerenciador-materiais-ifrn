<?php

namespace App\Models;

use App\Enums\EstadoConservacaoEnum;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    // Isto serve para transformar o Enum em string
    protected $casts = [
        'estado_conservacao' => EstadoConservacaoEnum::class
    ];

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }

    public function local(): BelongsTo
    {
        return $this->belongsTo(Local::class);
    }

    // TODO: Renomear para foto
    public function arquivo(): HasOne
    {
        return $this->hasOne(Arquivo::class);
    }

    /**
     * Verifica a disponibilidade do Material.
     * 
     * @return array Um booleano e uma string, onde:
     *   o booleano indica se o Material está disponível e
     *   a string indica o motivo. Se o Material estiver disponível, a string é vazia.
     */
    public function disponivel(): array
    {
        // Verifica o estado de conservação primeiro, pois é mais fácil
        switch ($this->estado_conservacao) {
            case EstadoConservacaoEnum::EmManutencao:
                return [false, 'Em manutenção'];
            case EstadoConservacaoEnum::Danificado:
                return [false, 'Danificado'];
        }
        // Está em bom estado; verifica se está emprestado
        $dados = \DB::table('emprestimo_material')
            ->join('emprestimos', 'emprestimos.id', '=', 'emprestimo_material.emprestimo_id')
            ->join('materiais', 'materiais.id', '=', 'emprestimo_material.material_id')
            ->select('emprestimos.id')
            ->limit(1)
            /* TODO: Verificar se o empréstimo foi devolvido.
             * Atualmente, quando um empréstimo é devolvido, ele é apagado do banco,
             * então o fato de ele existir significa que não foi devolvido. */
            ->get();
        if (count($dados) > 0) {
            $emprestimo = Emprestimo::find($dados[0]->id);
            return [false, "Emprestado a {$emprestimo->usuario_que_recebeu}"];
        }
        return [true, ''];
    }
}
