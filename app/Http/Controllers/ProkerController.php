<?php

namespace App\Http\Controllers;


use App\Models\Proker;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProkerRequest;
use Illuminate\Support\Facades\Auth;

class ProkerController extends Controller
{

    public function list(){
        return view('pages.proker.proker');
    }

    public function show(Request $request, $slug){
        $proker = Proker::with('user','division')->where('slug_proker', $slug)->first();
        return view('pages.proker.detail-proker',[
           'proker' => $proker
        ]);
    }
    public function index(){
        return view('dashboard.manage-proker.proker');
    }

    public function createDashboard(){
        return view('dashboard.manage-proker.form-proker',[
            'action' => 'store',
            'uniqId' => null,
            'divisions' => Division::where('status_division','publish')->get()
        ]);
    }

    public function storeDashboard(ProkerRequest $prokerRequest){
        DB::beginTransaction();
        try{
            $location = $prokerRequest->thumbnail->store('thumbnail_proker');
            Proker::create([
                'user_id' => Auth::id(),
                'division_id' =>$prokerRequest->division_id,
                'name_proker' => $prokerRequest->nama,
                'status_proker' => $prokerRequest->status ?? 'draft',
                'thumbnail_proker' => 'storage/'.$location,
                'description_proker' => $prokerRequest->description_proker,
                'start_proker' => $prokerRequest->mulai,
                'end_proker' => $prokerRequest->akhir
            ]);
            DB::commit();
            session()->flash('messageAction','success');
            return to_route('manage-proker');
        }
        catch(\Throwable $th){
            DB::rollback();
            Log::error('error store proker', [
                'error' => $th->getMessage(),
            ]);
            session()->flash('messageAction','error');
            return redirect()->back();
        }
    }

    public function editDashboard(Request $request){
        if(is_null($request->slug)){
            return to_route('manage-proker');
        }

        $proker = Proker::where('slug_proker',$request->slug)->first();
        if(is_null($proker)){
            return to_route('manage-proker');
        }

        return view('dashboard.manage-proker.form-proker',[
            'action' => 'update',
            'uniqId' => encrypt($proker->id),
            'status' => $proker->status_proker,
            'division_id' => $proker->division_id,
            'divisions' => Division::where('status_division','publish')->get(),
            'nama' => $proker->name_proker,
            'description_proker' => $proker->description_proker,
            'thumbnail_now' => $proker->thumbnail_proker,
            'mulai' => $proker->start_proker,
            'akhir' => $proker->end_proker
        ]);
    }

    public function updatedashboard(ProkerRequest $prokerRequest){
        DB::beginTransaction();
        try{
            $proker = Proker::findOrFail(decrypt($prokerRequest->uniqId));
            $location = $proker->thumbnail_proker;
            if(!is_null($prokerRequest->thumbnail)){
                $location = 'storage/' .$prokerRequest->thumbnail->store('thumbnail_proker');
            }

            $proker->update([
                'uniqId' =>  encrypt($prokerRequest->id),
                'status_proker' => $prokerRequest->status ?? 'draft',
                'division_id' => $prokerRequest->division_id,
                'name_proker' => $prokerRequest->nama,
                'description_proker' => $prokerRequest->description_proker,
                'thumbnail_proker' => $location,
                'start_proker' => $prokerRequest->mulai,
                'end_proker' => $prokerRequest->akhir
            ]);
            DB::commit();
            session()->flash('messageAction','success');
            return to_route('manage-proker');
        }catch(\Throwable $th){
            DB::rollBack();
            Log::error('error update proker', [
                'error' => $th->getMessage(),
            ]);
            session()->flash('messageAction','error');
            return redirect()->back();
        }
    }
}