<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Result;
use Faker\Generator as Faker;

$factory->define(Result::class, function (Faker $faker) {
    $users = [
        'Addie Bernhard', 'Bianka Hintz', 'Caleigh Carter Jr.', 'Dariana Wyman', 'Emery Maggio',
        'Felipa Gusikowski', 'Gustave Little', 'Heloise Ernser', 'Isabell Spinka', 'Jammie Nienow',
    ];

    $numberOfHands = $faker->numberBetween(10, 30);
    $userScore = $faker->numberBetween(1, $numberOfHands);
    $generatedHandScore = $numberOfHands - $userScore;

    return [
        'user_name' => $users[array_rand($users, 1)],
        'user_score' => $userScore,
        'generated_hand_score' => $generatedHandScore,
        'user_won' => $userScore > $generatedHandScore ? 1 : 0,
    ];
});
