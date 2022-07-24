<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'base_company'; 

    protected $fillable = [
        
        'name_en',
        'name_th',
        'phone',
        'email',
        'no',
        'mu',
        'street',
        'province',
        'amphure',
        'district',
        'postcode'
    ];
}
