<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
          'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }



    public function messages()

    {
        return [

            'photo.required' => 'The photo field is required.',
         'photo.image' => 'The file must be an image.',
          'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
        'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
    ];
}



public function prepareForValidation()
{
    if ($this->hasFile('photo'))
     {
         $photoPath = $this->file('photo')->store('photos', 'public');
         $this->merge(['photo' => $photoPath]);
         }
        }

}



