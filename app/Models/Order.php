<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_plan_id',
        'date',
        'food',
        'driver_id',
        'order_status',
        
        
    ];

    public function name()
    {
        return $this->belongsTo(User::class,'driver_id');
    }
}
