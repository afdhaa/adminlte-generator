<?php

namespace Database\Factories;

use App\Models\CalonSiswaMinat;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalonSiswaMinatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CalonSiswaMinat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'calon_siswa_id' => $this->faker->randomDigitNotNull,
        'minat_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
