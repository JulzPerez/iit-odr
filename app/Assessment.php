<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessment_of_fees';

    protected $fillable = ['requests_id','fees_id','number_of_copy','number_of_pages','amount'];
}
