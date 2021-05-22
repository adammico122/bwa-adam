<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = $this->request->get('id');
        return [
            'name'          => 'required|string|max:75',
            'email'         => 'required|email|unique:users,email,'.$user,
            'roles'         => 'nullable|string|in:Admin,User',
            'address_one'   => 'nullable|string',
            'address_two'   => 'nullable|string',
            'provinces_id'  => 'nullable|exists:provinces,id',
            'regencies_id'  => 'nullable|exists:regencies,id',
            'zip_code'      => 'nullable|numeric|max:12',
            'country'       => 'nullable|string',
            'phone_number'  => 'required|string',
            'store_name'    => 'nullable|string',
            'categories_id' => 'nullable|exists:categories,id',
            'store_status'  => 'nullable|numeric'
        ];
    }
}
