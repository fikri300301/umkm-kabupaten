<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class ArticleRequest extends FormRequest
{
    protected $validationAttributes = [];
    public function __construct(Request $request)
    {
        parent::__construct();
        if(!isset($request->uniqId)){
            $this->validationAttributes = array_merge($this->validationAttributes,[
                'title' => ['required','string','min:2','max:255',Rule::unique('articles','title_article')],
                'thumbnail' =>['required','image','mimes:jpg,png,svg,webp']
            ]);
        }else{
            $this->validationAttributes = array_merge($this->validationAttributes,[
                'title' => ['required','string','min:2','max:255','unique:articles,title_article,'.decrypt($request->uniqId)],
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
            'article' => ['required','string']
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