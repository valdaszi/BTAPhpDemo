<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RadarFormRequest extends FormRequest
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
            'date' => 'required | date',
            'distance' => 'required | numeric',
            'time' => 'required | numeric',
            'number' => 'required | string | max:6 | min:1'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            if ($data['time']) {
                $speed = $data['distance'] / $data['time'] * 3.6;
                if ($speed < 50 || $speed > 300) {
                    $validator->errors()->add('speed', trans('validation.wrong_speed', ['attribute' => $speed]));
                }
            }
        });
    }
}
