<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\umkm;
use App\Models\Bidang;
use App\Models\Bantuan;
use App\Models\Category;
use App\Models\Kecamatan;
use App\Models\Pelatihan;
use App\Models\Perizinan;
use App\Exports\ExportUmkm;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Http\Requests\UmkmRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UmkmController extends Controller
{
    public function fullView()
    {

        $data = umkm::with(['bidang', 'kecamatan', 'desa', 'category',])->orderBy('nama', 'asc')->get();
        return view(
            'livewire.umkm-view',
            [
                'data' => $data
            ]
        );
    }

    public function export_excel()
    {
        return Excel::download(new ExportUmkm, "umkm.xlsx");
    }
    // public $slug_umkm='';
    public function createDashboard()
    {
        return view('dashboard.manage-umkm.createumkm', [
            'action' => 'store',
            'slug_umkm' => null,
            'uniqId' => null,
            'bidang' => Bidang::all(),
            'kecamatan' => Kecamatan::all(),
            'desa' => Desa::all(),
            'kecamtan' => Kecamatan::all(),
            'categories' => Category::all(),
            'perizinan' => Perizinan::all(),
            'bantuan' => Bantuan::all(),
            'pelatihan' => Pelatihan::all(),
            'kecamatan_id' => null,
        ]);
    }

    public function storeDashboard(Request $request)
    {
        //  dd($request);
        try {
            $validated = $request->validate([
                'nama' => 'required',
                'bidang_id' => 'required',
                'produk' => 'required',
                'pemilik' => 'required',
                'telepon' => 'required',
                'rt' => 'required',
                'rw' => 'required',
                'desa_id' => 'required',
                'kecamatan_id' => 'required',
                'nik' => 'required|unique:umkms',
                'kapasitas_produk' => 'required',
                'tenaga_kerja' => 'required',
                'modal_usaha' => 'required',
                'daerah_pemasaran' => 'required',
                'categories_id' => 'required',

            ]);
            $umkm = umkm::create($request->all());
            session()->flash('messageAction', 'success');
            return to_route('dashboard');
        } catch (\Throwable $th) {
            //dd($th);
        }
    }

    public function editdashboard($slug_umkm)
    {

        $umkm = umkm::where('slug_umkm', $slug_umkm)->first();
        return view('dashboard.manage-umkm.createumkm', [
            'action' => 'update',
            'uniqId' => encrypt($umkm->id),
            'slug_umkm' => $umkm->slug_umkm,
            'nama' => $umkm->nama,
            'bidang_id' => $umkm->bidang_id,
            'bidang' => Bidang::all(),
            'produk' => $umkm->produk,
            'pemilik' => $umkm->pemilik,
            'telepon' => $umkm->telepon,
            'nik' => $umkm->nik,
            'alamat' => $umkm->alamat,
            'rt' => $umkm->rt,
            'rw' => $umkm->rw,
            'desa_id' => $umkm->desa_id,
            'kapasitas_produk' => $umkm->kapasitas_produk,
            'omset' => $umkm->omset,
            'tenaga_kerja' => $umkm->tenaga_kerja,
            'daerah_pemasaran' => $umkm->daerah_pemasaran,
            'modal_usaha' => $umkm->modal_usaha,
            'categories_id' => $umkm->categories_id,
            'perizinan_id' => $umkm->perizinan_id,
            'kecamatan' => Kecamatan::all(),
            'kecamatan_id' => $umkm->kecamatan_id,
            'kecamatan_select' => $umkm->kecamatan_id,
            'bantuan' => Bantuan::all(),
            'pelatihan' => $umkm->pelatihan,
            'desa' => Desa::all(),
            'kecamtan' => Kecamatan::all(),
            'categories' => Category::all(),
            'perizinan' => Perizinan::all(),
            // 'bantuan' => $umkm->bantuan->name_bantuan,
            'pelatihans' => Pelatihan::all()
        ]);
    }

    public function updateDashboard(UmkmRequest $umkmRequest)
    {
        // dd($request);
        $umkm = umkm::findOrFail(decrypt($umkmRequest->uniqId));
        try {
            $umkm->update([
                'uniqid' => encrypt($umkmRequest->id),
                'nama' => $umkmRequest->nama,
                'bidang_id' => $umkmRequest->bidang_id,
                'produk' => $umkmRequest->produk,
                'pemilik' => $umkmRequest->pemilik,
                'telepon' => $umkmRequest->telepon,
                'nik' => $umkmRequest->nik,
                'alamat' => $umkmRequest->alamat,
                'rt' => $umkmRequest->rt,
                'rw' => $umkmRequest->rw,
                'kecamatan_id' => $umkmRequest->kecamatan_id,
                'desa_id' => $umkmRequest->desa_id,
                'kapasitas_produk' => $umkmRequest->kapasitas_produk,
                'omset' => $umkmRequest->omset,
                'tenaga_kerja' => $umkmRequest->tenaga_kerja,
                'daerah_pemasaran' => $umkmRequest->daerah_pemasaran,
                'modal_usaha' => $umkmRequest->modal_usaha,
                'categories_id' => $umkmRequest->categories_id,
                'perizinan_id' => $umkmRequest->perizinan_id
            ]);
            DB::commit();

            session()->flash('messageAction', 'success');
            return to_route('dashboard');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
