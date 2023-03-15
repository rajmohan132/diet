<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPlan extends Model
{
    use HasFactory;
        protected $fillable = [
    'subplancode',
    'splanname',
    'planname',
    'price',
    'status',
];
}
