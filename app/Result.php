<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    protected $fillable = [
        'full_name', 'age', 'gender', '5k', '10k', 'half', 'full', 'location'
    ];
}
