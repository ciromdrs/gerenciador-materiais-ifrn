<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Material;
use Livewire\Component;

class BuscarItens extends Component
{
    public $material = null;
    public $itens = [];
    public $materiais = [];

    public function mount()
    {
        $this->itens = Item::all();
        $this->materiais = Material::orderBy('nome','asc')->get();     
    }

    public function render()
    {

        if ($this->material == 0) {
            $this->itens = Item::all();
            return view('livewire.buscar-itens', ['itens' => $this->itens, 'materiais' => $this->materiais]);
        } else {
            $this->itens = Item::where('material_id', '=', $this->material)->get();
            return view('livewire.buscar-itens', ['itens' => $this->itens, 'materiais' => $this->materiais]);
        }
    }
}
