<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'first_name'    => $this->faker->firstName(),
            'last_name'     => $this->faker->lastName(),
            'gender'        => $this->faker->randomElement([1, 2, 3]),
            'email'         => $this->faker->unique()->safeEmail(),
            'tel'           => $this->faker->numerify('090########'), // ハイフンなし
            'address'       => $this->faker->address(),
            'building'      => $this->faker->optional()->company(),
            'category_id'   => Category::inRandomOrder()->first()->id, // 既存カテゴリのID使用
            'detail'        => $this->faker->realText(120),
        ];
    }
}