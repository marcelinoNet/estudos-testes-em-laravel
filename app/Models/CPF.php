<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPF extends Model
{
  
    public $fillable = ['cpf'];

    protected bool $result;


    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
        $this->valid = $this->validaCPF();
    }

    private function validaCPF() {
        $cpf = $this->cpf;        
        $cpf = $this->extrair_numeros_do_cpf_informado($cpf);     
        if (!$this->validar_total_numeros_cpf($cpf)) return false;
        if (!$this->validar_se_todos_numeros_digitos_repetidos_cpf($cpf)) return false;
        if(!(intval($cpf[9]) === $this->calcular_digitos_verificador($cpf, 9))) return false;
        if(!(intval($cpf[10]) === $this->calcular_digitos_verificador($cpf, 10))) return false;
        return true;
    }

    private function calcular_digitos_verificador($cpf, $digito_verificador){
        $total = 0;
        $digito_aux = $digito_verificador+1;
        for($i = 0; $i < $digito_verificador-1; $i++){
            $total += $cpf[$i] * $digito_aux;
            $digito_aux--;
        }
        $resto = $total%11;
        if($resto < 2) return 0;
        return 11 - $resto;
    }

    private function extrair_numeros_do_cpf_informado($cpf){
        return preg_replace( '/[^0-9]/is', '', $cpf );
    }

    private function validar_total_numeros_cpf($cpf){
        if (strlen($cpf) != 11) return false;
        return true;
    }

    private function validar_se_todos_numeros_digitos_repetidos_cpf($cpf){
        if (preg_match('/(\d)\1{10}/', $cpf)) return false;
        return true;
    }   

    

}
