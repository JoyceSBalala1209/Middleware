<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $table = 'routes_input';

    protected $fillable = [
        'senderloc',
        'recipientloc',
        'wholevehicle',
        'cargotype',
        'length',
        'width',
        'height',
        'weight',
        
    ];


    protected $primaryKey = 'orderID';

}
