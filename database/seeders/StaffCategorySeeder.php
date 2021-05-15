<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('staff_categories');
        if ($table->count() === 0)
        {
            $table->insert(['sc_id' => 1, 'sc_name' => "Dekan", 'sc_desc' => "Dekan Kampus"]);
            $table->insert(['sc_id' => 2, 'sc_name' => "Kaprodi", 'sc_desc' => "Kaprodi Kampus"]);
            $table->insert(['sc_id' => 3, 'sc_name' => "Dosen", 'sc_desc' => "Dosen Kampus"]);
            $table->insert(['sc_id' => 4, 'sc_name' => "Administrasi", 'sc_desc' => "Administrasi Kampus"]);
            $table->insert(['sc_id' => 5, 'sc_name' => "Pegawai", 'sc_desc' => "Pegawai Kampus"]);
        }
    }
}
