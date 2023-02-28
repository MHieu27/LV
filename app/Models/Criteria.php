<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinelab\NeoEloquent\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_criteria'
    ];
    public function type(){
        return $this->belongsToMany(User_type::class,'Criteria_Type');
    }
    public function point(){
        return $this->hasMany(Point::class);
    }
}
