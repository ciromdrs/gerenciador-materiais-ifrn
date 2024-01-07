<?php

namespace App\Livewire;

use App\Models\Local;
use Livewire\Component;

class BuscarLocais extends Component
{
    public $locais=[]; 
    public $local; 

    public function mount(){
        $this->locais = Local::orderBy('nome','asc')->get();
    }

    public function render()
    {
        $this->locais= \DB::table('locais')->where('nome','like',$this->local.'%')->orderBy('nome','asc')->get();    

        return view('livewire.buscar-locais',['locais'=>$this->locais]);
    }
}
