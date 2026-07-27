<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; 
    protected $primaryKey = 'id';
    public $timestamps = true; 

    protected $fillable = [
        'full_name', // SQL එකේ ඇති නමම වේ[cite: 1]
        'email', 
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}