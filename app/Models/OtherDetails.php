<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDetails extends Model
{
    use HasFactory;

    protected $table = 'other_details';

    protected $fillable = [
        'remarks',
        'inclusion',
        
    ];


    protected $primaryKey = 'orderID';
}
