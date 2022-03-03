<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortUrlRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'long_url'       => 'required|string|url',
            'expire_at'      => 'nullable|date_format:"Y-m-d\TH:i"',
            'attempt'        => 'nullable|integer',
            'time_frame'     => 'nullable|integer',
            'block_duration' => 'nullable|integer',
        ];
    }
}
