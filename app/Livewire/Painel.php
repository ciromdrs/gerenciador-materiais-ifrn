<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Material;
use Livewire\Component;

class Painel extends Component
{
    public $categorias=[];
    public $materiais=[];
    public $filter=0;


    public function mount()
    {
        $this->categorias = Categoria::orderBy('asc')->get();
        $this->materiais = Material::all();
    }


    public function define($value)
    {
        $this->filter = $value;
    }

    public function render()
    {
        if($this->filter!=0){

            $id = $this->filter;
            $this->materiais= Material::whereHas('categorias',function($query) use ($id){
                $query->where('categorias.id',$id);
            })->get();
        }else{
            $this->materiais= Material::all();
        }

        return view('livewire.painel');
    }
}
