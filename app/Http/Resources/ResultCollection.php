<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'user_name' => $this->user_name,
            'number_of_games_won' => $this->games_won,
            'number_of_hands_won' => (int) $this->hands_won,
        ];
    }
}
