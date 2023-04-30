<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinelab\NeoEloquent\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'img',
        'description'
    ];
    public function detail(){
        return $this->hasMany(Session_detail::class);
    }
    public function category(){
        return $this->hasMany(Category::class,'Product_Category');
    }
    public function user($rating){
        return $this->hasMany(User::class,'User_Product')->ofMany([
            'rating' => $rating,
        ]);
    }
}
