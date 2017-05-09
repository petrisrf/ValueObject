<?php

namespace Common\ValueObject\Person;

use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @dataProvider invalid_cpf_provider
     */
    public function should_throw_exception_when_cpf_is_invalid($cpf)
    {
        new CPF($cpf);
    }

    public function invalid_cpf_provider()
    {
        return [
            ['cpf' => '069.694.929-65'],
            ['cpf' => '111.111.111-11'],
            ['cpf' => '222.222.222-22'],
            ['cpf' => '069.222.222-22'],
            ['cpf' => '069.694.333-35'],
            ['cpf' => 'asd'],
            ['cpf' => '069.929-65'],
            ['cpf' => '069.564.929-651'],
            ['cpf' => '069.123.929-12'],
        ];
    }
}