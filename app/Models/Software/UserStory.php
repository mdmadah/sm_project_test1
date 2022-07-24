<?php

namespace App\Models\Software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStory extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'software_user_stories'; 

    protected $fillable = [
        
        // 'id',
        'us_id',
        'user_story_detail',
        'duration',
        'at_id',
        'prio_id',
        'sw_id',
        'status',
        'us_budget'
    ];
}
