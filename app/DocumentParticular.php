<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentParticular extends Model
{
    //
    protected $fillable = ['documents_id', 'docParticularName' ];

    /* public function particularsDoc()
    {
        return $this->belongsTo('App\Document');
    } */
}
