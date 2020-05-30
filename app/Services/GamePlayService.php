<?php

namespace App\Services;

use Illuminate\Support\Str;

class GamePlayService
{
    private $cardValues = [
        "2" => 2, "3" => 3, "4" => 4, "5" => 5,
        "6" => 6, "7" => 7, "8" => 8, "9" => 9,
        "10" => 10, "J" => 11, "Q" => 12, "K" => 13, "A" => 14
    ];

    private $validCards = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    private $userScore = 0;
    private $generatedHandScore = 0;

    /**
     * calculateResults
     *
     * @param  mixed Request $request
     * @return void
     */
    public function calculateResults($request)
    {
        $handOfCards = explode(' ', Str::upper($request->hand_of_cards));

        $generatedHandOfCards = [];
        for ($i = 0; $i < sizeof($handOfCards); $i++) {
            array_push($generatedHandOfCards, $this->validCards[array_rand($this->validCards, 1)]);
        }

        for ($i = 0; $i < sizeof($handOfCards); $i++) {
            $handOfCardsValue = array_key_exists($handOfCards[$i], $this->cardValues) ? $this->cardValues[$handOfCards[$i]] : null;
            $generatedHandOfCardsValue = array_key_exists($generatedHandOfCards[$i], $this->cardValues) ? $this->cardValues[$generatedHandOfCards[$i]] : null;

            if ($handOfCardsValue > $generatedHandOfCardsValue) {
                $this->userScore++;
            }
            if ($handOfCardsValue < $generatedHandOfCardsValue) {
                $this->generatedHandScore++;
            }
        }

        return [
            'userScore' => $this->userScore,
            'generatedHandScore' => $this->generatedHandScore,
        ];
    }
}
