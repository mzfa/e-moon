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
        $data = DB::select(DB::raw('select
            progress.progress_id,
            progress.minggu_ke,
            progress.start,
            progress.finish,
            sum(progress_detail.bobot) as bobot,
            sum(progress_detail.bobot_rencana) as bobot_rencana,
            sum(progress_detail.bobot_minggu_ini) as realisasi_mingguan,
            sum(progress_detail.bobot) - sum(progress_detail.bobot_sd_minggu_ini) as deviasi
        from
            progress
        left join progress_detail on
            progress_detail.progress_id = progress.progress_id
        where
            progress.deleted_at is null group by 
        progress.progress_id,minggu_ke,start,finish,progress_detail.bobot,progress_detail.bobot_rencana,progress_detail.bobot_minggu_ini'));
        // dd($data);
        $indikator1 = '';
        $indikator2 = '';
        $keterangan = '';
        foreach($data as $item){
            $indikator1 .= $item->bobot_rencana.',';
            $indikator2 .= $item->realisasi_mingguan.',';
            $keterangan .= $item->minggu_ke.',';
        }
        // dd($indikator1,$indikator2,$keterangan);
        $indikator1 = substr($indikator1, 0, -1);
        $indikator2 = substr($indikator2, 0, -1);
        $keterangan = substr($keterangan, 0, -1);
        return view('home', compact('indikator1','indikator2','keterangan'));
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
