<?php

namespace Database\Factories;

use App\Models\User;
use General\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'u_id' => rand(-2147483648,2147483647),
            'u_ut_id' => 1,
            'u_username' => '@'.$this->faker->firstName(),
            // 'email' => $this->faker->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'u_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),
            'u_rec_status' => 1,
            'u_rec_createdby' => 'system',
            'u_rec_created' => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
