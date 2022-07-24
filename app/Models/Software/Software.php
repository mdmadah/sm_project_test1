<?php

namespace App\Models\Software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Software extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'softwares'; 

    protected $fillable = [
        
        // 'id',
        'name',
        'allBudget',
        'expectedBudget', 
        'signDate',
        'startDate',
        'endDate',
        'duration',
        'owner_id',
        'sm_id',
        'status'
    ];
}
