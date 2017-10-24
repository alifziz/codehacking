<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Must be true to check rules , false will show forbidden    
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
            //
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'is_active' => 'required',
            'role_id' => 'required',
            'password' => 'required|min:6'
        ];
    }
}
