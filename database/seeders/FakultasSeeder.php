<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('fakultas');
        if ($table->count() === 0)
        {
            $table->insert(['fks_id' => 1,'fks_name' => 'TEKNIK','fks_desc' => 'Fakultas Teknik','fks_rec_status' => 1,'fks_rec_createdby' => 'system','fks_rec_created' => now()]);
            $table->insert(['fks_id' => 2,'fks_name' => 'EKONOMI','fks_desc' => 'Fakultas Ekonomi','fks_rec_status' => 1,'fks_rec_createdby' => 'system','fks_rec_created' => now()]);
            $table->insert(['fks_id' => 3,'fks_name' => 'SASTRA','fks_desc' => 'Fakultas Sastra','fks_rec_status' => 1,'fks_rec_createdby' => 'system','fks_rec_created' => now()]);
            $table->insert(['fks_id' => 4,'fks_name' => 'HUKUM','fks_desc' => 'Fakultas Hukum','fks_rec_status' => 1,'fks_rec_createdby' => 'system','fks_rec_created' => now()]);
            $table->insert(['fks_id' => 5,'fks_name' => 'MIPA','fks_desc' => 'Fakultas MIPA','fks_rec_status' => 1,'fks_rec_createdby' => 'system','fks_rec_created' => now()]);
            $table->insert(['fks_id' => 6,'fks_name' => 'KIP','fks_desc' => 'Fakultas KIP','fks_rec_status' => 1,'fks_rec_createdby' => 'system','fks_rec_created' => now()]);
        }
    }
}
