<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = ['docName','docParticular'];

    /* public function docparticulars()
    {
        return $this->hasMany('App\DocumentParticular');
    } */
}
