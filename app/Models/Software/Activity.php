<?php

namespace App\Models\Software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'software_activities'; 

    protected $fillable = [
        'ac_id',
        'name',
        'NT',
        'rush_day',
        'rush_cost_per_day',
        'ts_id',
        'us_id',
        'previous_act_id',
        'status',
    ];
}
