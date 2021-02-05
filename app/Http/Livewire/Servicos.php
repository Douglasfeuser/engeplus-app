<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servico;

class Servicos extends Component
{
    public $servicos, $name, $value, $servico_id;
    public $isOpen = 0;

    public function render()
    {
        $this->servicos = Servico::all();
        return view('livewire.servicos.lista');
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
        $this->servico_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        Servico::updateOrCreate(['id' => $this->servico_id], [
            'name' => $this->name,
            'value' => $this->value
        ]);

        session()->flash('message',
            $this->servico_id ? 'Servico Updated Successfully.' : 'Servico criado com sucesso.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $servico = Servico::findOrFail($id);
        $this->servico_id = $id;
        $this->name = $servico->name;
        $this->value = $servico->value;

        $this->openModal();
    }

    public function delete($id)
    {
        Servico::find($id)->delete();
        session()->flash('message', 'Servico excluido com sucesso.');
    }
}
