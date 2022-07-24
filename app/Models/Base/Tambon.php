<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tambon extends Model
{
    use HasFactory;
    protected $table = 'tambons'; 
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tambon',
        'amphoe',
        'province',
        'zipcode',
        'tambon_code',
        'amphoe_code',
        'province_code',
        'status'
    ];
}
