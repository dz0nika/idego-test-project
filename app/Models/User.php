<?php

namespace App\Models;

use App\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'two_factor_enabled',
        'two_factor_secret',
        'two_factor_confirmed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return model's eloquent builder instance
     *
     * @param  \Illuminate\Database\Query\Builder  $builder
     * @return \App\Builders\UserBuilder
     */
    public function newEloquentBuilder($builder)
    {
        return new UserBuilder($builder);
    }

    /**
     * Generate new two factor auth secret
     *
     * @return void
     */
    public function generateTwoFactorAuthCode()
    {
        $code = '111111'; // TODO: implement random code generation of 6 numbers and send code to user

        $this->update([
            'two_factor_secret' => '111111',
        ]);
    }
}
