<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyRequest extends FormRequest
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
        $rules = 'required'; 
        foreach($this->request->get('profileIds') as $key => $val) { 
            $rules['profileIds.'.$key] = 'required'; 
          } 
        return $rules; 
    }


    public function messages() { 
        $messages = []; 
        foreach($this->request->get('profileIds') as $key => $val) { 
          $messages['profileIds.'.$key] = 'The Profile Id '.$val.'" is not valid.'; 
        } 
        return $messages; 
      }
}
