<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    private int $FREIGHT = 1000;

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    protected $fillable = [
        'name', 'price', 'weight','height','depth','width','order_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function is_Quantity_Valid(){
        if($this->quantity < 0) return false;
        return true;
    }

    public function is_Weight_Valid(){
        if($this->weight < 0) return false;
        return true;
    }

    public function is_Dimensions_Valid(){
        if($this->height < 0 || $this->depth < 0 || $this->width < 0) return false;
        return true;
    }
    public function calculate_Volume(){
        return floatval(($this->height/100) * ($this->depth/100) * ($this->width/100));
    }
    public function calculate_Density(){
        return intval($this->weight / $this->calculate_Volume());
    }

    public function calculate_Freight(){
        $freight = $this->FREIGHT * $this->calculate_Volume() * ($this->calculate_Density()/100);

        return $freight > 10.00 ? $freight : 10.00;
    }

    public function calculate_total(){
        return $this->price * $this->quantity;
    }
}
