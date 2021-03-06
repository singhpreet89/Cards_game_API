<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_name' => $this->user_name,
            'player_hand_score' => $this->user_score,
            'generated_hand_score' => $this->generated_hand_score,
            'result' => $this->user_won === 1 ? "Won" : "Lost"
        ];
    }
}
