<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BagianController extends Controller
{
    public function index()
    {
        $data = DB::table('bagian')
        ->whereNull('bagian.deleted_at')
        ->get();
        return view('bagian', compact('data'));
    }

    public function sync()
    {
        $list_bagian_phis = DB::connection('PHIS-V2')
            ->table('bagian')
            ->select([
                'bagian_id',
                'input_time',
                'input_user_id',
                'mod_time',
                'mod_user_id',
                'status_batal',
                'nama_bagian',
                'referensi_bagian',
                'group_bagian',
            ])
            ->orderBy('bagian_id')
            ->get();

        foreach ($list_bagian_phis as $bagian) {
            if ($bagian->status_batal) {
                $deleted_at = $bagian->mod_time ?? now();
                $deleted_by = $bagian->mod_user_id ?? 1;
            } else {
                $deleted_at = null;
                $deleted_by = null;
            }
            $datanya[] = [
                'bagian_id' => $bagian->bagian_id,
                'created_at' => $bagian->input_time,
                'created_by' => $bagian->input_user_id,
                'updated_at' => $bagian->mod_time,
                'updated_by' => $bagian->mod_user_id,
                'deleted_at' => $deleted_at,
                'deleted_by' => $deleted_by,
                // 'referensi_id' => $bagian->referensi_bagian,
                'referensi_bagian' => $bagian->referensi_bagian,
                'nama_bagian' => $bagian->nama_bagian
            ];
        }

        DB::table('bagian')->truncate();
        DB::table('bagian')->insert($datanya);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!']);

        // return redirect()->back()->with('status', ['success', 'Data berhasil disimpan']);
    }
}
