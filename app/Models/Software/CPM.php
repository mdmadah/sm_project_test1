<?php

namespace App\Models\Software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPM extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'software_cpms'; 

    protected $fillable = [
        'sw_id',
        'us_id',
        'act_id',
        'f_act_id',
        'pre_id',
        'f_pre_id',
        'duration',
        'ES',
        'EF',
        'LF',
        'LS',
        'SL',
        'rush_day',
        'status'
        
    ];
}
