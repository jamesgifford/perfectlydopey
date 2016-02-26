<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    
    protected $fillable = [
        'runner_id', 'year', 'full_name', 'first_name', 'last_name', 'age', 'gender', '5k_time', '10k_time', 'half_time', 'full_time', 'location', 'city', 'state', 'country'
    ];
}
