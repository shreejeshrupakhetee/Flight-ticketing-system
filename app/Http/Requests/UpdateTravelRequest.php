<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'leavingcity'=>'required | not_in:leaving',
            'goingcity'=>'required | not_in:going',
            'departure'=>'required',
            'seatAvailable'=>'required | regex:/[0-9]/',
            'price'=>'required',
            'travelname'=>'required | not_in:name',
            'traveltype'=>'required | not_in:type',
            'travel_date'=>'required',
            'flightno'=>'required'
        ];
    }
}
