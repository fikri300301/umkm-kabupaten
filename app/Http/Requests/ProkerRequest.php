<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProkerRequest extends FormRequest
{
    protected $validationAttributes = [];
    public function __construct(Request $request){
        parent::__construct();
        if(is_null($request->uniqId)){
            $this->validationAttributes = array_merge($this->validationAttributes,[
                'nama' => ['required','string','min:2','max:255',Rule::unique('prokers','name_proker')],
                'thumbnail' => ['required','image','mimes:jpg,png,svg,webp']
            ]);
        }else{
            $this->validationAttributes = array_merge($this->validationAttributes,[
                'nama' => ['required','string','min:2','max:255','unique:prokers,name_proker,'.decrypt($request->uniqId)],
                'thumbnail' => ['image','mimes:jpg,png,svg,webp']
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
            'division_id' => ['string'],
            'description_proker' => ['required','string'],
            'mulai' => ['required','date'],
            'akhir' => ['required',
            'date',
            function ($attribute,$value,$fail) {
                $startDate = $this->input('mulai');
                $endDate = $value;

                if($startDate && $endDate && $startDate > $endDate){
                    $fail('penutupan harus lebih atau sama dengan pembukaan');
                }
            }
            ]
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