<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Comissoes extends Component
{
    public $comissoes, $user;

    public function render()
    {
        $this->user = auth()->user();
        $this->comissoes = DB::table('vendas')->where('vendedor', $this->user->id)->get();

        return view('livewire.comissao.lista');
    }

}
