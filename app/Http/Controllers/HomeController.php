<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        // dump(Session('profesi_id'));
        // $jenis_pendidikan = DB::table('jenis_pendidikan')->whereNull('jenis_pendidikan.deleted_at')->count();
        // $pegawai = DB::table('pegawai')->whereNull('pegawai.deleted_at')->count();
        // $keluarga_pegawai = DB::table('keluarga_pegawai')->whereNull('keluarga_pegawai.deleted_at')->count();
        // $pelatihan_pegawai = DB::table('pelatihan_pegawai')->whereNull('pelatihan_pegawai.deleted_at')->count();
        // dd($jenis_pendidikan);
        return view('home');
    }

    public function buat_password(Request $request){
        $pegawai_id = Auth::user()->pegawai_id;
        $request->validate([
            'password_detail' => ['required', 'string'],
        ]);
        // dd($pegawai_id);
        $data = [
            'password_detail' => $request->password_detail,
        ];
        DB::table('pegawai')->where(['pegawai_id' => $pegawai_id])->update($data);
        session(['password_detail' => $request->password_detail]);
        return Redirect::back()->with(['success' => 'Password Berhasil di buat!']);
    }
}
