<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'image',
        'email',
        'phone',
        'address',
        'password',
        'subject',
    ];

    protected $hidden = [
        'password'
    ];
}
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'image',
        'email',
        'phone',
        'address',
        'password',
        'subject',
    ];

    protected $hidden = [
        'password'
    ];
}
