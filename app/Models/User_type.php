<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinelab\NeoEloquent\Eloquent\Model;

class User_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_type'
    ];
    public function user(){
        return $this->hasMany(User::class);
    }
    public function criteria(){
        return $this->belongsToMany(Criteria::class,'Type_Critera');
    }
}
