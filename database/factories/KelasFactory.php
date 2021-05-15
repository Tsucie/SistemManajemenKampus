<?php

namespace Database\Factories;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kelas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kls_id' => rand(-2147483648,2147483647),
            'kls_code' => '',
            'kls_name' => '',
            'kls_capacity' => 30,
            'kls_mhs_count' => 0,
            'kls_desc' => null
        ];
    }
}
