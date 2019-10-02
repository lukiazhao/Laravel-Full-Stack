<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->is_employer;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $salary_period = [];
        if (!$this->use_range) {
            array_push($salary_period, 'required');
        }

        return [
            'title' => 'required',
            'city' => 'required',
            'type_id' => 'required|exists:types,id',
            'classification' => 'required|exists:classifications,id',
            'closing_date' => 'nullable|date_format:Y-m-d',
            'salary' => 'required',
            'payment_period' => $salary_period,
        ];
    }
}
