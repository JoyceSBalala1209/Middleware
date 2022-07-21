<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerForum extends Model
{
    use HasFactory;

    protected $table = 'customer_forum';

    protected $fillable = [
     
        'customer_id',
        'post',
    ];

    protected $primaryKey = 'id';
}
