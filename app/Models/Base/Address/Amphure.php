<?php

namespace App\Models\Base\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amphure extends Model
{
    use HasFactory;

    protected $table = 'amphures'; 

    protected $fillable = [
        'id',
        'code',
        'name_th',
        'name_en', 
        'province_id',
    ];
}
