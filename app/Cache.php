<?php

namespace App;

use Config;
use Illuminate\Database\Eloquent\Model;

class Cache extends Model
{
    protected $table = 'cache';

    protected $fillable = [
        'data'
    ];
}
