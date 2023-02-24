<?php

namespace Tests\Unit;

use App\Models\CPF;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    
    public function test_cpf_is_valid()
    {
        $cpf = '880.951.380-02';
        $validade_cpf = new CPF(['cpf' => $cpf]);
        $this->assertTrue($validade_cpf->valid);
    }


    public function test_cpf_is_invalid()
    {
        $cpf = '111.111.312-99';
        $validade_cpf = new CPF(['cpf' => $cpf]);
        $this->assertFalse($validade_cpf->valid);
    }

    public function test_cpf_with_less_than_11_digits()
    {
        $cpf = '111.111.312-9';
        $validade_cpf = new CPF(['cpf' => $cpf]);
        $this->assertFalse($validade_cpf->valid);
    }

    public function test_cpf_with_more_than_11_digits()
    {
        $cpf = '111.111.312-922';
        $validade_cpf = new CPF(['cpf' => $cpf]);
        $this->assertFalse($validade_cpf->valid);
    }
}
