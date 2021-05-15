<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('user_types');
        if ($table->count() === 0)
        {
            $table->insert(['ut_id' => 1, 'ut_name' => "Client", 'ut_desc' => "Pemilik Kampus"]);
            $table->insert(['ut_id' => 2, 'ut_name' => "Site", 'ut_desc' => "Rektor & Wakil Rektor"]);
            $table->insert(['ut_id' => 3, 'ut_name' => "Staff", 'ut_desc' => "Dekan, Kaprodi, Administrasi, Dosen, & Karyawan"]);
            $table->insert(['ut_id' => 4, 'ut_name' => "Mahasiswa", 'ut_desc' => "Mahasiswa Kampus"]);
        }
    }
}
