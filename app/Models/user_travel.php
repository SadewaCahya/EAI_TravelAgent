<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_travel extends Model
{
    use HasFactory;

    protected $table = 'users_travels';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function orders() {
        return $this->hasMany(order::class, 'user_id');
    }
}
