<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Result;
use Faker\Generator as Faker;

$factory->define(Result::class, function (Faker $faker) {
    $users = [
        'Addie Bernhard', 'Bianka Hintz', 'Caleigh Carter Jr.', 'Dariana Wyman', 'Emery Maggio',
        'Felipa Gusikowski', 'Gustave Little', 'Heloise Ernser', 'Isabell Spinka', 'Jammie Nienow',
    ];

    $user = $users[array_rand($users, 1)];
    $numberOfHands = $faker->numberBetween(10, 30);

    /* MAKING SURE that 'Addies Bernhard' and 'Jammie Nienow' do not win any Game */
    $userScore = $generatedHandScore = 0;
    if ($user === 'Addie Bernhard' || $user === 'Jammie Nienow') {
        $generatedHandScore = $faker->numberBetween(round($numberOfHands / 2) + 1, $numberOfHands);
        $userScore = $numberOfHands - $generatedHandScore;
    } else {
        $userScore = $faker->numberBetween(1, $numberOfHands);
        $generatedHandScore = $numberOfHands - $userScore;
    }

    return [
        'user_name' => $user,
        'user_score' => $userScore,
        'generated_hand_score' => $generatedHandScore,
        'user_won' => $userScore > $generatedHandScore ? 1 : 0,
    ];
});
