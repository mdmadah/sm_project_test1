<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_employee_detail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'user_employee_details'; 
    protected $fillable = [
        'id',
        'user_id',
        'facebook',
        'line',
        'position_id',
        
        'no',
        'mu',
        'street',
        'province',
        'amphure',
        'district', 
        'postcode'

        
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
