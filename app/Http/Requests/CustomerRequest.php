<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'fullName' => 'required|string|max:255',
            'account_type' => 'required|string',
            'type' => 'required|string',
            'birthday' => 'required|date',
            'notes' => 'string',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|unique:phones',
            'address' => 'sometimes|string',
            'group' => 'sometimes|string',

        ];
    }


    public function prepareForValidation()
     {
      if ($this->hasFile('photo')) {
             $photoPath = $this->file('photo')->store('photos', 'public');
              $this->merge(['photo' => $photoPath]);

             }
             }
}


