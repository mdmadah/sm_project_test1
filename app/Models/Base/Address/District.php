<?php

namespace App\Models\Base\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts'; 

    protected $fillable = [
        'id',
        'zip_code',
        'name_th',
        'name_en', 
        'amphure_id',
        'status',
    ];
}
