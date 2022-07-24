<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStoryType extends Model
{
    use HasFactory;

    protected $table = 'base_activity_types'; 

    protected $fillable = [
        'name',
        'status',
    ];
}
