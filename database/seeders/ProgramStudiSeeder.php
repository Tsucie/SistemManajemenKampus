<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('program_studis');
        if ($table->count() === 0)
        {
            $table->insert(['ps_id' => 11,'ps_fks_id' => 1,'ps_name' => 'INFORMATIKA','ps_desc' => 'Teknik Informatika S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 12,'ps_fks_id' => 1,'ps_name' => 'MESIN','ps_desc' => 'Teknik Mesin S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 13,'ps_fks_id' => 1,'ps_name' => 'ELEKTRO','ps_desc' => 'Teknik Elektro S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 14,'ps_fks_id' => 1,'ps_name' => 'INDUSTRI','ps_desc' => 'Teknik Industri S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 15,'ps_fks_id' => 1,'ps_name' => 'KIMIA','ps_desc' => 'Teknik Kimia S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 21,'ps_fks_id' => 2,'ps_name' => 'MANAJEMEN','ps_desc' => 'Manajemen S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 22,'ps_fks_id' => 2,'ps_name' => 'AKUNTANSI','ps_desc' => 'Akuntansi S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 31,'ps_fks_id' => 3,'ps_name' => 'SASTRA INDONESIA','ps_desc' => 'Sastra Indonesia S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 32,'ps_fks_id' => 3,'ps_name' => 'SASTRA INGGRIS','ps_desc' => 'Sastra Inggris S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 41,'ps_fks_id' => 4,'ps_name' => 'ILMU HUKUM','ps_desc' => 'Ilmu Hukum S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 51,'ps_fks_id' => 5,'ps_name' => 'MATEMATIKA','ps_desc' => 'Matematika S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
            $table->insert(['ps_id' => 61,'ps_fks_id' => 6,'ps_name' => 'PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN','ps_desc' => 'Pendidikan Pancasila dan Kewarganegaraan S1','ps_rec_status' => 1,'ps_rec_createdby' => 'system','ps_rec_created' => now()]);
        }
    }
}
