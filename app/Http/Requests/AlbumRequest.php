<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
{
    protected $validationAttributes = [];

    public function __construct(Request $request){
       // dd($request);
        parent::__construct();
        if(!isset($request->uniqId)){
            $this->validationAttributes = array_merge($this->validationAttributes,[
                'name' => ['required','string','min:2','max:255',Rule::unique('albums','name_album')],

            ]);
        }else{
            $this->validationAttributes = array_merge($this->validationAttributes,[
                'name' => ['required','string','min:2','max:255','unique:albums,name_album,'.decrypt($request->uniqId)]
            ]);
        }
        }


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function getValidators(){
        $validation = [
            'description_album' => ['required','string']
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