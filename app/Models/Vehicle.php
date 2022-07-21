<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'verify_merchant';

    protected $fillable = [
        'id',
        'vehicle_type',
        
    ];
}
