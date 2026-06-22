<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'gebruikers';


    protected $fillable = [
        'naam',
        'email',
        'wachtwoord',
        'role',
    ];


    protected $hidden = [
        'wachtwoord',
    ];


    protected $casts = [
        'wachtwoord' => 'hashed',
    ];


    public function getAuthPassword()
    {
        return $this->wachtwoord;
    }
}