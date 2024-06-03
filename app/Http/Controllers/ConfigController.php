<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfilebemRequest;

class ConfigController extends Controller
{
    public function indexDashboard()
    {
        $config = Config::first();
        return view('dashboard.config.profile-bem.formProfilebem', [
            'action' => 'update',
            'uniqId' => encrypt($config->id),
            'misi' => $config->misi,
            'visi' => $config->visi,
            'banner_now' => $config->banner,
        ]);
    }

    public function updateDashboard(ProfilebemRequest $profilebemRequest)
    {
        try {
            DB::beginTransaction();
            $config = Config::findOrFail(decrypt($profilebemRequest->uniqId));
            $location = $config->banner;
            if (!is_null($profilebemRequest->banner)) {
                $location = 'storage/' . $profilebemRequest->banner->store('banner');
            }

            $config->update([
                'uniqId' => encrypt($profilebemRequest->id),
                'misi' => $profilebemRequest->misi,
                'visi' => $profilebemRequest->visi,
                'banner' => $location,
            ]);

            DB::commit();
            session()->flash('messageAction', 'success');
            return to_route('profile-bem');
        } catch (\Throwable $th) {
            DB::rollback();
            session()->flash('messageAction', 'error');
            return redirect()->back();
        }
    }

    public function CreateDashboard()
    {
        return view('dashboard.config.profile-bem.formProfilebem', [
            'action' => 'store'
        ]);
    }

    public function storeDashboard(ProfilebemRequest $profilebemRequest)
    {
        DB::beginTransaction();
        try {
            $location = $profilebemRequest->banner->store('banner');
            Config::create([
                'misi' => $profilebemRequest->misi,
                'visi' => $profilebemRequest->visi,
                'banner' => 'storage/' . $location,
            ]);
            DB::commit();
            session()->flash('messageAction', 'success');
            return to_route('profile-bem');
        } catch (\Throwable $th) {
            DB::rollback();
            session()->flash('messageActioin', 'error');
            return redirect()->back();
        }
    }
    public function profileBem(){
        return view('pages.profile-bem.profile-bem');
    }
}
