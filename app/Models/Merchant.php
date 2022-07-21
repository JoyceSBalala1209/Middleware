<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Merchant  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'merchant';

    protected $fillable = [
     
        'email',
        'password',
        'first_name',
        'last_name',
        'profile_image',
        'contact_number',
        'name_of_business',
        'about',

    ];

    public $timestamps = false;

    protected $primaryKey = 'id';


    protected $hidden = [
        'password',
    ];

  

}
