<?php

namespace App\Http\Livewire;

use App\Models\Venda;
use Livewire\Component;

class Vendas extends Component
{
    public $vendas, $name, $detail, $venda_id;
    public $isOpen = 0;

    public function render()
    {
        $this->vendas = Venda::all();
        return view('livewire.vendas');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->detail = '';
        $this->venda_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Venda::updateOrCreate(['id' => $this->venda_id], [
            'name' => $this->name,
            'detail' => $this->detail
        ]);

        session()->flash('message',
            $this->venda_id ? 'Venda Updated Successfully.' : 'Venda criada com sucesso.');

        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $venda = Venda::findOrFail($id);
        $this->venda_id = $id;
        $this->name = $venda->name;
        $this->detail = $venda->detail;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Venda::find($id)->delete();
        session()->flash('message', 'Venda excluida com sucesso.');
    }
}
