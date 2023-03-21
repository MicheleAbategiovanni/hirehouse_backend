<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "title"=>"string|required",
            "num_rooms"=>"integer|nullable|between:0,15",
            "num_beds"=>"integer|nullable|between:0,15",
            "num_bathrooms"=>"integer|nullable|between:0,7",
            "square_meters"=>"integer|between:0,10000|nullable",
            "full_address"=>"string|required",
            "cover_img"=>"image|nullable",
            "visibile"=>"boolean|nullable",
            "price"=>"numeric|required|between:0,10000",
            "description"=>"string|nullable",
            "check_in"=>"string|nullable",
            "check_out"=>"string|nullable",
            // "latitude"=>"numeric|required",
            // "longitude"=>"numeric|required",
        
        ];
    }
}
