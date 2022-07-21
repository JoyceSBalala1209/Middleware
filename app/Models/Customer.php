<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
     
        'email',
        'password',
        'first_name',
        'last_name',
        'contact_number',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password',
    ];
}
