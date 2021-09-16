<?php

use Illuminate\Database\Seeder;
use App\Document;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::create([
            'docName' => 'Transcript of Record',
            'docParticular' => '',
            'doc_fee' => '50.00',
            'auto_assess' => '0',
            'require_file_upload' => '0'
        ]);

        Document::create([
            'docName' => 'Authentication',
            'docParticular' => 'TOR',
            'doc_fee' => '10.00',
            'require_file_upload' => '1'
        ]);
        Document::create([
            'docName' => 'Authentication',
            'docParticular' => 'Diploma',
            'doc_fee' => '10.00',
            'require_file_upload' => '1'
        ]);

        Document::create([
            'docName' => 'Certification',
            'docParticular' => 'Grade',
            'doc_fee' => '10.00',
            'require_file_upload' => '0'
        ]);

        Document::create([
            'docName' => 'CAV',
            'docParticular' => '',
            'doc_fee' => '10.00',
            'require_file_upload' => '0'
        ]);
    }
}
