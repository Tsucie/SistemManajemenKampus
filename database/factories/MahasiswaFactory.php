<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

// Untuk membuat Factory class ketikan artisan command: php artisan make:factory NamaFactory
// atau php artisan make:factory PostFactory --model=Nama untuk mensertakan modelnya
class MahasiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mahasiswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mhs_id' => rand(-2147483648,2147483647),
            'mhs_u_id',
            'mhs_fks_id',
            'mhs_ps_id',
            'mhs_kls_id',
            'mhs_fullname',
            'mhs_first_registered', // sm_code dimana mahasiswa pertama kali daftar
            'mhs_nim',
            'mhs_education',
            'mhs_address',
            'mhs_province',
            'mhs_city',
            'mhs_birthplace',
            'mhs_birthdate',
            'mhs_gender',
            'mhs_state',
            'mhs_email',
            'mhs_status',
            'mhs_contact',
            'mhs_ktp',
            'mhs_job'
        ];
    }
}
