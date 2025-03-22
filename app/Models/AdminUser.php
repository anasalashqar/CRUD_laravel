<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AdminUser extends Model
{
    // protected $table = 'admin_user'; // ✅ Specify the correct table name

    use HasFactory;

    // Here I allow whcih columns ar able to edit else is blocked
    protected $fillable = ['name', 'email', 'password', 'phone', 'role', 'is_active'];

    // converts it to true or false not 0 or 1
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
