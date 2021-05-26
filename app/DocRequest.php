<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocRequest extends Model
{
    protected $table = 'requests';

    protected $fillable = ['requestor_id', 'document_id','number_of_copy','filename' ];
}
