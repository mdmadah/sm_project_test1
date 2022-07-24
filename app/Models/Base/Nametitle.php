<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nametitle extends Model
{
    use HasFactory;
    protected $table = 'base_name_titles'; 

    protected $fillable = [
        'name',
        'status',
    ];
}
