<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Emprestimo;
use App\Models\Material;
use Livewire\Component;

class TelaEmprestimos extends Component
{
    public $itens = [];
    public $materiais = [];
    public $carrinho = [];
    public $remove = [];
    public $ok = [];
    public $responsavel = null;
    public $filtro_material = null;
    public $msg = null;

    public function mount()
    {
        $this->itens = Item::all();
    }

    public function emprestar()
    {
        if (!$this->carrinho || !$this->responsavel) {//verifica algum dos campos está vazio, se tiver nada faz
            // TODO: Reescrever ifs ternários na forma $a = teste ? valor_se_true : valor_se_false
            $this->carrinho==null ?  $this->msg="Nada foi selecionado": "";
            $this->responsavel==null ?  $this->msg="Informe uma matrícula": "";
        } else {//se não tiver vazio, cai dentro desse else
            $this->msg=null;
            $emprestimo = Emprestimo::create([
                'usuario_que_emprestou' => \App\Models\Session::first()->identificacao,
                'usuario_que_recebeu' => $this->responsavel,
            ]);
            $itens = $this->carrinho;
            
            //Esse try/catch é importante porque caso exista algum erro em anexar os itens a um emprestimo, ele desnexa se algum existir e apagar o empréstimo para que ele
            //não fique redundante
            try {
                for ($i = 0; $i < sizeof($itens); $i++) {
                    $emprestimo->itens()->attach($itens[$i]);
                    $itens[$i]->disponibilidade = false;
                    $itens[$i]->save();
                }
                $this->carrinho = [];
                $this->responsavel = "";
            } catch (\Throwable $th) {
                $this->carrinho = [];
                $this->responsavel = "";
                $emprestimo->itens()->detach();
                $emprestimo->delete();
            }
        }
    }

    public function adicionar(Item $item)
    {
        //NÃO APAGAR!!!!!!!!!!!!!!!
        //essa função remove o item da array itens e coloca o item na lista de carrinho, é apenas visual, deixei salva caso precise modificar
        // if (!$item->disponibilidade ==  0) {
        //     foreach ($this->itens as $key => $value) {
        //         if ($item->id == $value->id) {
        //             //      Item encontrado, remova-o do array
        //             unset($this->itens[$key]);
        //             break; // Pode parar a iteração após encontrar e remover o item
        //         }
        //     }
        //     $this->carrinho[] = $item;
        // }

        if (!$item->disponibilidade == 0) {
            // Verifica se o item já está presente no carrinho
            $indiceExistente = array_search($item->id, array_column($this->carrinho, 'id'));

            if ($indiceExistente === false) {
                // Item não está no carrinho, adiciona-o
                $this->carrinho[] = $item;
            }
        }
    }

    public function remover(Item $item)
    {
        //buscando o índice do item
        $num = array_search($item, $this->carrinho);
        //retirando da array
        unset($this->carrinho[$num]);
        //reorganizando a arraylist
        $this->carrinho = array_values($this->carrinho);
    }

    public function render()
    {
        $this->materiais = Material::orderBy('nome', 'asc')->get();
        if (!$this->filtro_material == 0) {
            $this->itens = Item::where('material_id', $this->filtro_material)->get();
        } else {
            $this->mount();
        }
        return view('livewire.tela-emprestimos', ['carrinho_itens' => $this->carrinho]);
    }
}
