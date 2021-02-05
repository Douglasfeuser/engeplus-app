<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produto;

class Produtos extends Component
{
    public $produtos, $name, $value, $produto_id;
    public $isOpen = 0;

    public function render()
    {
        $this->produtos = Produto::all();
        return view('livewire.produtos.lista');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->name = '';
        $this->value = '';
        $this->produto_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        Produto::updateOrCreate(['id' => $this->produto_id], [
            'name' => $this->name,
            'value' => $this->value
        ]);

        session()->flash('message',
            $this->produto_id ? 'Produto Updated Successfully.' : 'Produto criado com sucesso.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $this->produto_id = $id;
        $this->name = $produto->name;
        $this->value = $produto->value;

        $this->openModal();
    }

    public function delete($id)
    {
        Produto::find($id)->delete();
        session()->flash('message', 'Produto excluido com sucesso.');
    }
}
