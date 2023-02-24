<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'descount', 'experation_date'
    ];


    public function is_Experated(){
        if($this->experation_date >= Carbon::now()) return false;
        return true;
    }
    
}
