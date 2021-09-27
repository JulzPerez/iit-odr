<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = ['docName','docParticular','require_file_upload','auto_assess', 'doc_fee'];

    /* public function docparticulars()
    {
        return $this->hasMany('App\DocumentParticular');
    } */
}
