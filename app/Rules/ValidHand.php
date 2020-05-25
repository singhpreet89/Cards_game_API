<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidHand implements Rule
{
    private $invalidHands = array();

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $hand_of_cards_value)
    {
        $hands = explode(" ", $hand_of_cards_value);

        for ($i = 0; $i < sizeof($hands); $i++) {
            $hand = $hands[$i];
            if (!preg_match('/[23456789JQKAjqka ]|(10)/', $hand)) {
                array_push($this->invalidHands, $hand);
            }
        }

        if (empty($this->invalidHands)) {
            return 1;   // All Valid Hands passed
        } else {
            return 0;   // 1 or more Invalid hands passed
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid cards: ' . implode(', ', $this->invalidHands);
    }
}
