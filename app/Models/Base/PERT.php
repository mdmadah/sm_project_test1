<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PERT extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'base_perts'; 

    protected $fillable = [
        'tus_id',
        'ET',
        'NT',
        'LT',        
        'status',
    ];
}
