<?php

namespace App\Http\Requests\Api\v1\AnimalController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|unique:animals,name',
            'kind' => 'required|exists:animal_kinds,kind',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо указать имя питомца',
            'name.unique' => 'Питомец с таким именем уже существует',
            'name.required' => 'Необходимо указать тип питомца',
            'name.exists' => 'Такого типа питомца не существует',
        ];
    }
}
