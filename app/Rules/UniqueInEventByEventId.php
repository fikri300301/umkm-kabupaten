<?php

namespace App\Rules;

use App\Models\TeamEvent;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueInEventByEventId implements ValidationRule
{
    public $eventId;
    public $codeTim;

    public function __construct($eventId, $codeTim = null)
    {
        $this->eventId = $eventId;
        $this->codeTim = $codeTim;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $attr = $attribute.'_tim';
        $finded = TeamEvent::where($attr, $value)->where('event_id', $this->eventId)->first();
        if(!is_null($finded)){
            if (!is_null($this->codeTim)) {
                if($finded->code_tim != $this->codeTim){
                    $fail("{$attribute} Sudah pernah di pakai daftar event ini.");
                }
            }else{
                $fail("{$attribute} Sudah pernah di pakai daftar event ini.");
            }
        }
    }
}
