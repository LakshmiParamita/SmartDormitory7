<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLogin extends Authenticatable
{
    use HasFactory;

    protected $table = 'userlogin';
    protected $fillable = ['username', 'password'];
}
