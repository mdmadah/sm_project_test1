<?php

namespace App\Models\Software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accelerate_history extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'software_accelerate_histories'; 

    protected $fillable = [
        'sw_id',
        'us_id',
        'act_id',
        'rush_day',
        'status'

    ];
}