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
 * @property string $username
 * @property string $email
 * @property string $bio
 * @property string $image
 * @property string $passwordHash
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
    protected $primaryKey = 'email';
    protected $label = 'Person';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'id',
        'bio',
        'image',
        'password',
        'email_verified_at',
    ];

  /*   protected $hidden = [
        'passwordHash',
    ]; */
    public function getAuthIdentifier(): string
    {
        return $this->email;
    }
}
