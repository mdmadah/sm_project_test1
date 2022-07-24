<?php

namespace App\Models\Base\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces'; 

    protected $fillable = [
        
        'id',
        'code',
        'name_th',
        'name_en', 
        'geography_id',
    ];
}
