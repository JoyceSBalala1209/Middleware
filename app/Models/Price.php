<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table = 'price_input';

    protected $fillable = [
        'mode_of_payment',
        'sender_name',
        'sender_number',
        'recipient_name',
        'recipient_number',
        'distance',
        'price',

        
    ];


    protected $primaryKey = 'orderID';
}
