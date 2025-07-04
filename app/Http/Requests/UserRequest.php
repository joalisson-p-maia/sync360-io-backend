<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest{
    public function rules(): array{
        return [
            'profile' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'full_name' => 'required|string|max:60|min:4',
            'age' => 'required|integer|min:1|max:100',
            'street' => 'required|string|max:255|min:4',
            'neighborhood' => 'required|string|max:100|min:4',
            'state' => 'required|string|size:2|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'biography' => 'nullable|string|max:1000',
        ];
    }
}