<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'    => ['string','required',],
            'phone'    => ['string','required',],
            'password'    => ['string','confirmed','min:8',],
            'email'   => ['required','unique:users,email,' . request()->route('user')->id,],
            // 'roles.*' => [
            //     'integer',
            // ],
            // 'roles'   => [
            //     'required',
            //     'array',
            // ],
        ];
    }
}
