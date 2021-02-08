<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'detail', 'vendedor', 'value', 'comissao'
    ];

    public function itens()
    {
    	return $this->belongsToMany(Produto::class);
    }
}
