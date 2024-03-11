<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProyekController extends Controller
{
    public function index()
    {
        $data = DB::table('proyek')->whereNull('proyek.deleted_at')->get();
        return view('proyek.index', compact('data'));
    }
    public function store(Request $request){
        $request->validate([
            'nama_proyek' => ['required', 'string'],
            'alamat_proyek' => ['required', 'string'],
        ]);
        $durasi_kontrak  = date_diff( date_create($request->waktu_pelaksanaan_mulai), date_create($request->waktu_pelaksanaan_berakhir));
        $data = [
            'created_by' => Auth::user()->id,
            'created_at' => now(),
            'nama_proyek' => $request->nama_proyek,
            'alamat_proyek' => $request->alamat_proyek,
            'pemberi_tugas' => $request->pemberi_tugas,
            'manajemen_konstruksi' => $request->manajemen_konstruksi,
            'konsultan_perencana' => $request->konsultan_perencana,
            'kontraktor' => $request->kontraktor,
            'waktu_pelaksanaan_mulai' => $request->waktu_pelaksanaan_mulai,
            'waktu_pelaksanaan_berakhir' => $request->waktu_pelaksanaan_berakhir,
            'uraian_data' => $request->uraian_data,
            'durasi_kontrak' => $durasi_kontrak->format('%a'),
            'pro_prof_pic' => $request->pro_prof_pic,
            'lokasi' => $request->lokasi,
        ];
        DB::table('proyek')->insert($data);

        return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!']);
    }

    public function edit($id)
    {
        // $id = Crypt::decrypt($id);
        // dd($data);
        $text = "Data tidak ditemukan";
        if($data = DB::select("SELECT * FROM proyek WHERE proyek_id='$id'")){

            $text = '<div class="mb-3">'.
                    '<label for="staticEmail" class="form-label">Nama Proyek</label>'.
                    '<input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="'.$data[0]->nama_proyek.'" required>'.
                '</div>'.
                '<div class="mb-3">'.
                '<label for="staticEmail" class="form-label">Alamat Proyek</label>'.
                '<input type="text" class="form-control" id="alamat_proyek" name="alamat_proyek" value="'.$data[0]->alamat_proyek.'" required>'.
            '</div>'.
                '<input type="hidden" class="form-control" id="proyek_id" name="proyek_id" value="'.Crypt::encrypt($data[0]->proyek_id) .'" required>';
        }
        return $text;
        // return view('proyek.edit');
    }

    public function update(Request $request){
        $request->validate([
            'nama_proyek' => ['required', 'string'],
            'alamat_proyek' => ['required', 'string'],
        ]);
        $data = [
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
            'nama_proyek' => $request->nama_proyek,
            'alamat_proyek' => $request->alamat_proyek,
        ];
        $proyek_id = Crypt::decrypt($request->proyek_id);
        $status_proyek = "Aktif";
        DB::table('proyek')->where(['proyek_id' => $proyek_id])->update($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Ubah!']);
    }
    public function delete($id){
        $id = Crypt::decrypt($id);
        $data = [
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now(),
        ];
        DB::table('proyek')->where(['proyek_id' => $id])->update($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus!']);
    }
    
}
