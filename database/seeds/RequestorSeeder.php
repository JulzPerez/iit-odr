<?php

use Illuminate\Database\Seeder;
use App\Requestor;

class RequestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requestor::create([
            'user_id' => '2',
            'first_name' => 'julieto',
            'middle_name' => 'ebasco',
            'last_name' => 'perez',
            //'maiden_name' => $request['docname'],
            //'id_no' => $request['id_no'],
            'requestor_type' => 'Alumnus',
            'contact_no' => '09171729431',
            //'home_address' => $request['home_address'], 
            //'mailing_address' => $request['mailing_address'],
            'degree' => 'BSCS',
            'major_option' => 'Computer Science',
            //'academic_distinction' => $request['honor'],
            'date_of_graduation' => '2016-06-18',
            'highschool_graduated' => '2010-06-18', 
            'highschool_address' => 'Brgy 3, SFADS',
            'last_sem_attended' => '1st Sem',
            'last_sem_AY' => '2016-2017', 
            'last_university_attended' => 'MSU Maraw',
            
            'sex' => 'male',
            'date_of_birth' => '1987-05-28', 
            'religion' => 'roman catholic', 
            'place_of_birth' => 'ebro sfads', 
            'citizenship' => 'filipino',
            'civil_status' => 'Single', 
            'spouse' => 'n/a', 
            'name_of_father' => 'deceased', 
            'maiden_name_of_mother' => 'deceased', 
            'address_of_parents' => 'sfads', 
           
        ]);

    }
}
