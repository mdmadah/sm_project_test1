<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_owner_detail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'user_owner_details'; 
    protected $fillable = [
        'id',
        'user_id',
        'organ_name_en',
        'organ_name_th',
        'organ_phone',
        
        'organ_no',
        'organ_mu',
        'organ_street',
        'organ_province',
        'organ_amphure',
        'organ_district', 
        'organ_postcode'

        
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
