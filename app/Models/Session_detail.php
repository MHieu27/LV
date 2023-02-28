<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinelab\NeoEloquent\Eloquent\Model;

    class Session_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'price'
    ];
    public function purchase(){
        return $this->hasMany(Purchase_details::class);
    }
    public function session(){
        return $this->hasMany(Session::class,'Detail_Session');
    }
    public function product(){
        return $this->hasMany(Product::class,'Detail_Product');
    }
}
