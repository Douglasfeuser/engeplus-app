<?php

namespace Tests\Unit;
use App\Models\Venda;

use PHPUnit\Framework\TestCase;

class VendaTest extends TestCase
{
    /** @test */
    public function check_colunas_vendas()
    {
        $venda = new Venda;

        $expected = [
            'name', 'detail', 'vendedor', 'value', 'comissao'
        ];

        $arrayCompare = array_diff($expected, $venda->getFillable());

        $this->assertEquals(0, count($arrayCompare));
    }
}
