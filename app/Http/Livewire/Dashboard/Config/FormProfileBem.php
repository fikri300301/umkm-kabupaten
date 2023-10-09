<?php

namespace App\Http\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class FormProfileBem extends Component
{
    use WithFileUploads;

    public $misi;
    public $visi;
    public $banner_now;
    public $banner;
    public $logo_now;
    public $logo;
    public $descriptionLogo;
    public $slogan;
    public function mount(){
        $this->getAllData();
    }
    public function getAllData()
    {
        $data = Config::all();
        $this->misi = $data->where('key', 'misi')->first()->value;
        $this->visi = $data->where('key', 'visi')->first()->value;
        $this->banner_now = $data->where('key', 'banner')->first()->value;
        $this->logo_now = $data->where('key', 'image-filosofi-logo')->first();
        $this->descriptionLogo = $data->where('key', 'description-filosofi-logo')->first();
        $this->slogan = $data->where('key','slogan')->first();
    }
    public function render()
    {
        return view('dashboard.config.profile-bem.livewire.form-profile-bem');
    }
    public function updateMisi()
    {
        $this->validate([
            'misi' => 'required',
        ]);
        try {
            Config::where('key', 'misi')->update([
                'value' => $this->misi,
            ]);
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error update misi', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }
    public function updateVisi()
    {
        $this->validate([
            'visi' => 'required',
        ]);
        try {
            Config::where('key', 'visi')->update([
                'value' => $this->visi,
            ]);
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error update visi', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }
    public function updateBanner()
    {
        $this->validate([
            'banner' => 'required|image',
        ]);
        try {
            $path = 'storage/' . $this->banner->store('profile');
            Config::where('key', 'banner')->update([
                'value' => $path,
            ]);
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error update banner', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function updateLogo()
    {
        $this->validate([
            'logo' => 'required|image',
        ]);
        try {
            $path = 'storage/' . $this->logo->store('profile');
            Config::where('key', 'image-filosofi-logo')->update([
                'value' => $path,
            ]);
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error update image-filosofi-logo', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }
    public function updateDesLogo()
    {
        $this->validate([
            'descriptionLogo' => 'required',
        ]);
        try {
            Config::where('key', 'description-filosofi-logo')->update([
                'value' => $this->descriptionLogo,
            ]);
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error update description-filosofi-logo', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }
    public function updateSlogan()
    {
        $this->validate([
            'slogan' => 'required',
        ]);
        try {
            Config::where('key', 'slogan')->update([
                'value' => $this->slogan,
            ]);
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error update slogan', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    


}