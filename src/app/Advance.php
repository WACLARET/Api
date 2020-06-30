<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    protected $dates = [
        'created_at', 'updated_at', 's_lastrun'
    ];
}
