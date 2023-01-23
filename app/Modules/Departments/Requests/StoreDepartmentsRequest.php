<?php

namespace App\Modules\Departments\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StoreDepartmentsRequest extends Request
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
        
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
     
    }
}
