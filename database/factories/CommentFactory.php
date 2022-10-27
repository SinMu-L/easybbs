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
            'topic_id' => random_int(1,50),
            'user_id' => random_int(1,10),
            'pid' => random_int(1,20),
        ];
    }
}
