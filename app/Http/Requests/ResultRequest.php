<?php

namespace App\Http\Requests;

use App\Rules\ValidHand;
use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // Accept all name as input in all of the European Languages
        $this->user_name = trim(preg_replace('/[^A-Za-zÀ-ÿ ]/', '', filter_var($this->user_name, FILTER_SANITIZE_STRING)));
        
        // SANITIZED String, REMOVE anything which is not a NUMBER or SPACE, REPLACE Multiple SPACES with a Single SPACE, TRIMMED the leading and trailing spaces, 
        $this->hand_of_cards = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', '', filter_var($this->hand_of_cards, FILTER_SANITIZE_STRING))));

        $this->merge([
            'user_name' => $this->user_name,
            'hand_of_cards' => $this->hand_of_cards,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|max:255',
            'hand_of_cards' => ['required', 'max:255', new ValidHand()],  // Calling ValidHand RULE
        ];
    }
}
