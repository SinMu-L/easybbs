<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => '这里是评论'.$this->faker->text(),
            'topic_id' => random_int(1,5),
            'user_id' => random_int(1,5),
            'pid' => random_int(1,20),
        ];
    }
}
