<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EventRequest extends FormRequest
{
    protected $validationAttributes = [];

    public function __construct(Request $request){
        parent::__construct();
        if (is_null($request->uniqId)) {
            $this->validationAttributes = array_merge($this->validationAttributes, [
                'nama' => ['required', 'string', 'min:2', 'max:255', Rule::unique('events', 'name_event')->whereNull('deleted_at')],
                'thumbnail' => ['required', 'image', 'mimes:jpg,png,svg,webp'],
            ]);
        }else {
            $this->validationAttributes = array_merge($this->validationAttributes, [
                'nama' => ['required', 'string', 'min:2', 'max:255', 'unique:events,name_event,'.decrypt($request->uniqId).',id,deleted_at,NULL'],
                'thumbnail' => ['image', 'mimes:jpg,png,svg,webp'],
            ]);
        }

        //create event
        if (!is_null($request->requitments) && is_null($request->uniqId)) {
            $this->validationAttributes = array_merge($this->validationAttributes, [
                'requitments.titleInput.*' => ['required'],
                'requitments.typeInput.*' => ['required'],
                'requitments.required.*' => ['required'],
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
        $validation =  [
            'deskripsi' => ['required', 'string'],
            'pembukaan' => ['required', 'date'],
            'penutupan' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $startDate = $this->input('pembukaan');
                    $endDate = $value;

                    if ($startDate && $endDate && $startDate > $endDate) {
                        $fail('penutupan harus lebih atau sama dengan pembukaan.');
                    }
                },
            ],
            'tipe' => ['required'],
            'registration' => ['required'],
            'hasil' => ['required'],
            'maksimal'=> [function($attribute, $value, $fail){
                if ($this->input('registration') == 'team') {
                    if (is_null($value)) {
                        $fail($attribute .' wajib diisi.');
                    }
                }
            }],
        ];
        $validation = array_merge($validation, $this->validationAttributes);
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
