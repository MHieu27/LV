<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Vinelab\NeoEloquent\Eloquent\Model;

/**
 * 
 * @property int $id
 * @property string $email
 * @property string $Username
 * @property string $passwordHash
 * @property string $phonenumber
 * @property string $address
 * @property string $birthday
 * @property string $gender
 */
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        Authenticatable,
        Authorizable,
        CanResetPassword;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
    protected $label = 'User';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'username',
        'email',
        'password',
        'phonenumber',
        'address',
        'birthday',
        'gender',
    ];

    protected $hidden = [
        'passwordHash',
    ];
    public function getAuthIdentifier(): string
    {
        return $this->id;
    }
}
