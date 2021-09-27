<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadPayment extends Model
{
    protected $table = 'payment_proof';

    protected $fillable = [
        'request_id',
        'proof',
        'payment_for',
        'amount',
        'description',
        'payment_channel',
        'status' 
    ];
}
