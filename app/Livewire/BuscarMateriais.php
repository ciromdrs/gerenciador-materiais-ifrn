<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Material;
use Livewire\Component;

class BuscarMateriais extends Component
{
    public $materiais=[]; 
    public $material; 

    public function mount(){
        $this->materiais = Material::orderBy('nome','asc')->get();     
    }   

    public function render()
    {
        $this->materiais= Material::where('nome','like',$this->material.'%')->orderBy('nome','asc')->get();    

        return view('livewire.buscar-materiais',['materiais'=>$this->materiais]);
    }
}
