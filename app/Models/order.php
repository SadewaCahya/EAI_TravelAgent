<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 
        'ticket_id', 
        'quantity', 
        'total_price', 
        'status'
    ];

    public function user() {
        return $this->belongsTo(user_travel::class, 'user_id');
    }

    public function ticket() {
        return $this->belongsTo(ticket::class);
    }
}
