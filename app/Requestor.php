<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestor extends Model
{
    protected $table = 'requestor';

    protected $fillable = [
        'user_id','first_name','last_name', 'middle_name','maiden_name','id_no',
        'contact_no','home_address', 'mailing_address','degree','major_option','academic_distinction',
        'date_of_graduation', 'highschool_graduated', 'highschool_address',
        'last_sem_attended', 'last_sem_AY', 'last_university_attended',
        'purpose_of_request','sex','date_of_birth', 'religion', 'place_of_birth', 'citizenship',
        'civil_status', 'spouse', 'name_of_father', 'maiden_name_of_mother', 
        'address_of_parents', 'authorized_person'
    ];
}
