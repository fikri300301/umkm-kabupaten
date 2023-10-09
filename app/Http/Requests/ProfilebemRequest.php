<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProfilebemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $validationAttributes = [];
    public function __construct(Request $request){
        parent::__construct();
        if(!isset($request->uniqId)){
        $this->validationAttributes = array_merge($this->validationAttributes,[
            'banner' => ['required','image','mimes:jpg,png,svg,webp']
        ]);
    }else{
        $this->validationAttributes = array_merge($this->validationAttributes,[
           'banner' => ['image','mimes:jpg,png,svg,webp'] 
        ]);
    }
    }
    public function authorize(): bool
    {
        return true;
    }

    public function getValidators(){
        $validation = [
            'misi' => ['required','string'],
            'visi' => ['required','string']
        ];
        $validation = array_merge($validation,$this->validationAttributes);
        return $validation;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return $this->getValidators();
    }
}