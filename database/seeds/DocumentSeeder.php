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
            'require_file_upload' => '0'
        ]);

        Document::create([
            'docName' => 'Authentication',
            'docParticular' => 'TOR',
            'require_file_upload' => '1'
        ]);
        Document::create([
            'docName' => 'Authentication',
            'docParticular' => 'Diploma',
            'require_file_upload' => '1'
        ]);

        Document::create([
            'docName' => 'Certification',
            'docParticular' => 'Grade',
            'require_file_upload' => '0'
        ]);

        Document::create([
            'docName' => 'CAV',
            'docParticular' => '',
            'require_file_upload' => '0'
        ]);
    }
}
