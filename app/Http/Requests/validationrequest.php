<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:15', // تغيير التحقق من الرقم إلى سلسلة
            'time_opened' => 'required|date_format:H:i',
            'time_closed' => 'required|date_format:H:i',
            'address_id' => 'required|exists:address,id',
            'admin_id' => 'required|exists:users,id',
        ];
    }
}
