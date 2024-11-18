<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'details',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
