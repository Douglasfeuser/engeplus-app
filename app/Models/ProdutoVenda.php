<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class ProdutoVenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'venda_id', 'produto_id'
    ];

}
