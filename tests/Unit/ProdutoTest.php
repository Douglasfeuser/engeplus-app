<?php

namespace Tests\Unit;
use App\Models\Produto;

use PHPUnit\Framework\TestCase;

class ProdutoTest extends TestCase
{
    /** @test */
    public function check_colunas_produtos()
    {
        $produto = new Produto;

        $expected = [
            'name',
            'type',
            'value'
        ];

        $arrayCompare = array_diff($expected, $produto->getFillable());

        $this->assertEquals(0, count($arrayCompare));
    }
}
