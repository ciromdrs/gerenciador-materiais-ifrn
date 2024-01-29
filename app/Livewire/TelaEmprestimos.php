<?php

namespace App\Livewire;

use App\Models\Emprestimo;
use App\Models\Material;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TelaEmprestimos extends Component
{
    public $materiais = [];
    public $selecionados = [];
    public $responsavel = '';
    public $filtro_material = '';
    public $msg = '';

    public function mount()
    {
        $this->materiais = Material::all();
    }

    public function emprestar()
    {
        if (!$this->selecionados || !$this->responsavel) { //verifica algum dos campos está vazio, se tiver nada faz
            // TODO: Reescrever ifs ternários na forma $a = teste ? valor_se_true : valor_se_false
            $this->selecionados == null ? $this->msg = "Nada foi selecionado" : "";
            $this->responsavel == null ? $this->msg = "Informe uma matrícula" : "";
            return;
        }
        $this->msg = null;
        try {
            // Trabalha em uma transação para ficar fácil desfazer depois
            \DB::beginTransaction();
            // Cria o empréstimo
            $emprestimo = Emprestimo::create([
                'usuario_que_emprestou' => \App\Models\Session::first()->identificacao,
                'usuario_que_recebeu' => $this->responsavel,
            ]);
            // Associa os materiais selecionados
            for ($i = 0; $i < sizeof($this->selecionados); $i++) {
                $emprestimo->materiais()->attach($this->selecionados[$i]);
                $this->selecionados[$i]->save();
            }
            // Encerra a transação
            \DB::commit();
        } catch (\Throwable $th) {
            // Desfaz a transação
            \DB::rollBack();
        }
        $this->responsavel = "";
        $this->selecionados = [];
    }

    public function adicionar(Material $material)
    {
        if ($material->disponivel()[0]) {
            // Verifica se o material já foi selecionado
            $ja_selecionou = false;
            foreach ($this->selecionados as $sel) {
                if ($material->id == $sel->id) {
                    $ja_selecionou = true;
                    break;
                }
            }
            if (!$ja_selecionou) {
                // Material não foi selecionado, seleciona-o
                $this->selecionados[] = $material;
            }
        }
    }

    public function remover(Material $material)
    {
        //buscando o índice do material
        $num = array_search($material, $this->selecionados);
        //retirando da array
        unset($this->selecionados[$num]);
        //reorganizando a arraylist
        $this->selecionados = array_values($this->selecionados);
    }

    public function render()
    {
        $materiais = Material::with('local')->orderBy('nome', 'asc')->get();
        if ($this->filtro_material) {
            $materiais = self::filtrar_materiais($this->filtro_material, $materiais);
        }
        $this->materiais = $materiais;
        return view('livewire.tela-emprestimos');
    }

    public static function contem(
        string $texto,
        string $filtro,
        bool $ignorar_case = true,
        // TODO: Ignorar diacríticos
    ) {
        if ($ignorar_case) {
            $texto = strtolower($texto);
            $filtro = strtolower($filtro);
        }
        return str_contains($texto, $filtro);
    }

    public static function filtrar_materiais(
        string $filtro,
        Collection $materiais,
        bool $ignorar_case = true
    ): array {
        $filtrados = [];
        foreach ($materiais as $mat) {
            $campos = [$mat->nome, $mat->estado_conservacao->value, $mat->local->nome];
            foreach ($campos as $campo) {
                if (self::contem($campo, $filtro)) {
                    $filtrados[] = $mat;
                    break;
                }
            }
        }
        return $filtrados;
    }
}
