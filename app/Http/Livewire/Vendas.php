<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Venda;
use App\Models\Produto;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Vendas extends Component
{
    public $comissao, $user, $vendas, $name, $value, $detail, $venda_id, $itens = [], $produtos = [];
    public $isOpen = 0;


    public function render()
    {
        $this->vendas = Venda::all();
        $this->itens = Produto::all();
        $this->user = auth()->user();

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
        $this->produtos = [];
        $this->value = 0;
        $this->comissao = 0;
        $this->venda_id = '';

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store(Request $request)
    {

        $this->calculate();

        $this->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        $venda = Venda::updateOrCreate(['id' => $this->venda_id], [
            'name' => $this->name,
            'detail' => $this->detail,
            'vendedor' => $this->user->id,
            'value' => $this->value,
            'comissao' => $this->comissao,
        ]);

        foreach ($this->produtos as $produto) {
            $venda->itens()->attach($produto['produto_id']);
        }

        session()->flash('message',
            $this->venda_id ? 'Venda atualizada com sucesso.' : 'Venda criada com sucesso.');

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
        $user = User::findOrFail($venda->vendedor);
        $this->venda_id = $id;
        $this->name = $venda->name;
        $this->detail = $venda->detail;
        $this->value =  number_format($venda->value, 2);
        $this->comissao =  number_format($venda->comissao, 2);
        $this->user = $user;

        $this->produtos = [];

        $produtosVenda = DB::table('produto_venda')
                ->where('venda_id', $id)->get();

        foreach ($produtosVenda as $produtoVenda){
            $produto = DB::table('produtos')->find($produtoVenda->produto_id);

            $produto = array( 'produto_id' => $produto->id);
            array_push($this->produtos, $produto);
        }

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        DB::table('produto_venda')->where('venda_id', $id)->delete();
        Venda::find($id)->delete();
        session()->flash('message', 'Venda excluida com sucesso.');
    }

    public function addProduct()
    {
        $this->produtos[] = ['produto_id' => ''];
    }

    public function removeProduct($index)
    {
        unset($this->produtos[$index]);
        $this->produtos = array_values($this->produtos);
    }

    public function calculate()
    {
        $this->value = 0;
        $this->comissao = 0;

        foreach ($this->produtos as $produto) {
            $teste = Produto::findOrFail($produto['produto_id']);
            $this->value += $teste->value;
            if($teste->type == 1){
                $this->comissao += (10 / 100) * $teste->value;
            } else {
                // COMISSÃO PARA MAIS DE 5 ANOS
                if(strtotime($this->user->created_at) < strtotime('-5 year')){
                    $this->comissao += (30 / 100) * $teste->value;
                } else {
                    $this->comissao += (25 / 100) * $teste->value;
                }
            }
        }

        $this->value = number_format($this->value, 2);
        $this->comissao = number_format($this->comissao, 2);
    }
}
