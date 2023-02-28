<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinelab\NeoEloquent\Eloquent\Model;

class Purchase_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'price_purchase',
        'amount_purchase'
    ];
    public function user(){
        return $this->hasMany(User::class,'Has_Purchase');
    }
    public function detail(){
        return $this->hasMany(Session_detail::class,'Has_Session');
    }
}
