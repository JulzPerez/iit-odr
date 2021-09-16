<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'request_files';

    protected $fillable = ['request_id', 'filename' ];

}
