<?php

namespace Database\Factories;

use App\Models\Item;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'status' => $this->faker->randomElement(StatusEnum::getValues()),
        ];
    }
}
