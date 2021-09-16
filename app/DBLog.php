<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DBLog extends Model
{
    protected $table = 'db_log';

    protected $fillable = [
        'user_id','user_type','action', 'exception',
    ];
}
