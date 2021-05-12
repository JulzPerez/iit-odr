<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'fees';

    protected $fillable = ['fee_name', 'unit', 'amount' ];
}
