<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify_merchant extends Model
{
    use HasFactory;

    protected $table = 'verify_merchant';

    protected $fillable = [
        'id',
        'proof_of_identification',
        
    ];
}
