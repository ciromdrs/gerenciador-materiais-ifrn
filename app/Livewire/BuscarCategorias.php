<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class BuscarCategorias extends Component
{
    public $categoria;
    public $categorias=[];

    public function mount(){
        $this->categorias=Categoria::orderBy('nome','asc')->get();
    }

    public function render()
    {
        $this->categorias= \DB::table('categorias')->where('nome','like',$this->categoria.'%')->orderBy('nome','asc')->get();    
        return view('livewire.buscar-categorias',['categorias'=>$this->categorias]); 
    }
    
}
