<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = ['docName','docParticular','require_file_upload'];

    /* public function docparticulars()
    {
        return $this->hasMany('App\DocumentParticular');
    } */
}
