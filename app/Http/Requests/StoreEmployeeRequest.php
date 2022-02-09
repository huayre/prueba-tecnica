<?php

namespace App\Http\Requests;

use App\models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required|string',
            'last_name' => 'required|string',
            'dni' => ['required','numeric','digits:8', Rule::unique('employees')->ignore($this->id)],
            'email' => ['required','email',Rule::unique('employees')->ignore($this->id)],
            'birth_date' =>'required|date',
            'charge'=>'required|string',
            'area'=>'required|string',
            'contract_start_date'=>'required|date',
            'contract_end_date'=>'required|date',
            'type_contract'=>'required|string'
        ];
    }
}
