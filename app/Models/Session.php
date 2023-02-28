<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinelab\NeoEloquent\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = [
        'time_start',
        'time_end'
    ];
    public function user(){
        return $this->hasMany(User::class);
    }
    public function detail(){
        return $this->hasMany(Session_detail::class);
    }
}
