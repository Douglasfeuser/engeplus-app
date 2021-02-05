<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $casts = [
        'value' => 'float'
    ];

    protected $fillable = [
        'name',
        'value'
    ];
}
