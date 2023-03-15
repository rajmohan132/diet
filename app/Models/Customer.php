<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'streetaddress',
        'streetaddress1',
        'country',
        'mobno',
        'alternativemob',
        'status',
        
        
    ];

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
