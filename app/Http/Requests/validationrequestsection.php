<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequestsection extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'admin_id' => 'required',
           'address_id' => 'required',
            'time_opened' => 'required',
            'time_closed' => 'required',
            
           
        ];
    }
}
