<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    protected $fillable = [
        'cpf', 'freight', 'cupom_id'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function cupom(){
        return $this->hasOne(Cupom::class);
    }

    public function createNewOrderAndReturnTotal(array $products, string $cpf,Cupom $cupom = null){
        
        $validade_cpf = new CPF(['cpf' => $cpf]);
        if(!$validade_cpf->valid) return 'cpf invalido';

        if($this->has_duplicate_products($products)) return 'duplicate products is not allowed';

        $total = 0;
        foreach ($products as $product) {
            if(!$product->is_Quantity_Valid()) return 'invalid product quantity';
            if(!$product->is_Dimensions_Valid()) return 'invalid product dimesions';
            if(!$product->is_Weight_Valid()) return 'invalid product weight';
            $total += $product->calculate_total();
        }

        if($cupom && $cupom->is_Experated() != true) return  $total - ($total * $cupom->descount/100);

        return $total;
    }

    private function has_duplicate_products($products){
        return count($products) !== count(array_unique($products));
    }
}
