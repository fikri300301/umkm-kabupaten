<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UmkmRequest extends FormRequest
{

    protected $validationAttributes = [];

    public function __construct(Request $request){
        parent::__construct();
        if(!isset($request->uniqId)){
            $this->validationAttributes = array_merge($this->validationAttributes,[
                'nama' => ['required','string','min:2','max:255',Rule::unique('umkms','nama')],
                    
            ]);

        }else{
            $this->validationAttributes = array_merge($this->validationAttributes,[
                'nama' => ['required','string','min:2','max:255','unique:umkms,nama,'.decrypt($request->uniqId)]
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

    public function getvalidators(){
        $validation = [
            'bidang_id' => ['required'],
            'produk' => ['required','string','min:2','max:20'],
            'pemilik' => ['required','string','min:2','max:50'],
            'telepon' =>  ['required','string','min:2','max:13'],
            // 'nik' =>  ['required','string','min:2','max:16'],
            'rt' => ['required','string','max:3'],
            'rw' => ['required','string','max:3'],
            'desa_id' => ['required'],
            'kecamatan_id' => ['required'],
            'kapasitas_produk' => ['required','numeric'],
            'tenaga_kerja' => ['numeric'],
            'daerah_pemasaran' => ['required','string','min:2','max:255'],
            'categories_id' => ['required'],
            
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
        return $this->getvalidators();
    }
}