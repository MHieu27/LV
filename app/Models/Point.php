<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinelab\NeoEloquent\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'point'
    ];
    public function user(){
        return $this->hasMany(User::class,'User_Point');
    }
    public function criteria(){
        return $this->hasMany(Criteria::class,'Criteria_Point');
    }
}
