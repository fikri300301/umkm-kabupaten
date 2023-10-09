<?php

namespace App\Http\Livewire;

use App\Models\Contact as ModelsContact;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Contact extends Component
{
    public $name, $email, $subject, $message;
    protected $listeners = [
        'refresh' => '$refresh',
    ];
    public function render()
    {
        return view('livewire.contact');
    }
    public function resetAll(){
        $this->name = '';
        $this->email = '';
        $this->subject = '';
        $this->message = '';
    }
    public function store(){
        $this->validate([
            'name' => ['required'],
            'email' => ['required','email'],
            'subject' => ['required'],
            'message' => ['required'],
        ]);
        try {
            ModelsContact::create([
                'name_contact' => $this->name,
                'email_contact' => $this->email,
                'subject_contact' => $this->subject,
                'body_contact' => $this->message
            ]);
            $this->resetAll();
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Throwable $th) {
            Log::error('error create contact', [
                'error' => $th->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

}
