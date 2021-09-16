<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadPayment extends Model
{
    protected $table = 'upload_payment';

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
