<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        // $data = DB::table('users')->leftJoin('hakakses', 'users.hakakses_id', '=', 'hakakses.hakakses_id')
        // ->select([
        //     'users.*',
        //     'hakakses.nama_hakakses',
        // ])->whereNull('users.deleted_at')->get();
        $data = DB::table('users')
        ->leftJoin('user_akses', 'users.id', '=', 'user_akses.user_id')
        ->leftJoin('hakakses', 'user_akses.hakakses_id', '=', 'hakakses.hakakses_id')
        ->select([
            'users.*',
            'user_akses.jenis_akses',
            'hakakses.nama_hakakses',
        ])->whereNull('users.deleted_at')->get();
        return view('user', compact('data'));
    }

    public function sync()
    {
        $list_user = DB::connection('PHIS-V2')
            ->table('users')
            ->select([
                'user_id',
                'user_name',
                'user_password',
                'nama_pegawai',
                'status_batal',
                'pegawai_id',
            ])
            ->orderBy('user_id')
            ->get();
    
        $userid = Auth::user()->id;
        $datanya[] = [
            'id' => 0,
            'created_by' => $userid,
            'created_at' => now(),
            'deleted_by' => null,
            'deleted_at' => null,
            'username' => 'mzfa',
            'password' => 'mzfa',
            'name' => 'mzfa',
            'pegawai_id' => 0,
        ];
        foreach ($list_user as $item) {
            if($item->status_batal == null){
                $datanya[] = [
                    'id' => $item->user_id,
                    'created_by' => $userid,
                    'created_at' => now(),
                    'deleted_by' => null,
                    'deleted_at' => null,
                    'username' => $item->user_name,
                    'password' => $item->user_password,
                    'name' => $item->nama_pegawai,
                    'pegawai_id' => $item->pegawai_id,
                ];
            }else{
                $datanya[] = [
                    'id' => $item->user_id,
                    'created_by' => $userid,
                    'created_at' => now(),
                    'deleted_by' => 0,
                    'deleted_at' => now(),
                    'username' => $item->user_name,
                    'password' => $item->user_password,
                    'name' => $item->nama_pegawai,
                    'pegawai_id' => $item->pegawai_id,
                ];
            }
        }
        // dd($datanya);

        DB::table('users')->truncate();
        DB::table('users')->insert($datanya);
        return Redirect::back()->with('message', ['success', 'Data berhasil disimpan']);

        // return redirect()->back()->with('status', ['success', 'Data berhasil disimpan']);
    }

    public function edit($id)
    {
        // $id = Crypt::decrypt($id);
        // dd($data);
        $text = "Data tidak ditemukan";
        $hakakses = DB::table('hakakses')->get();
        if($data = DB::table('users')->leftJoin('user_akses', 'users.id', '=', 'user_akses.user_id')->where(['users.id' => $id])->first()){
        // dd($data);
        $text = '<div class="mb-3 row">'.
                    '<input type="hidden" name="user_id" value="'.Crypt::encrypt($id).'">'.
                    '<input type="hidden" name="user_akses_id" value="'.Crypt::encrypt($data->user_akses_id).'">'.
                    '<label for="staticEmail" class="col-sm-12 col-form-label">Hak Akses</label>'.
                    '<div class="col-sm-12">'.
                    '<select class="form-control" name="hakakses_id">'. 
                    '<option></option>';
                    foreach ($hakakses as $value) {
                        if($data->user_akses_id == $value->hakakses_id){
                            $text .= '<option checked value="'.$value->hakakses_id.'">'.$value->nama_hakakses.'</option>';
                        }else{
                            $text .= '<option value="'.$value->hakakses_id.'">'.$value->nama_hakakses.'</option>';
                        }
                    }
                    $text .= '</select>'.
                    '</div>'.
                '</div>';
        }
        return $text;
        // return view('admin.hakakses.edit');
    }
    // public function update(Request $request){
    //     $request->validate([
    //         'hakakses_id' => ['required', 'string'],
    //     ]);
    //     $data = [
    //         'updated_by' => Auth::user()->id,
    //         'updated_at' => now(),
    //         'hakakses_id' => $request->hakakses_id,
    //     ];
    //     $id = Crypt::decrypt($request->id);
    //     DB::table('users')->where(['id' => $id])->update($data);
    //     return Redirect::back()->with(['success' => 'Data Berhasil Di Ubah!']);
    // }
    public function update(Request $request){
        $request->validate([
            'user_id' => ['required'],
            'hakakses_id' => ['required'],
            // 'jenis_akses' => ['required', 'string'],
        ]);
        $user_id = Crypt::decrypt($request->user_id);
        $data = [
            'user_id' => $user_id,
            'hakakses_id' => $request->hakakses_id,
            // 'jenis_akses' => $request->jenis_akses,
        ];
        $user_akses_id = Crypt::decrypt($request->user_akses_id);
        if(isset($user_akses_id)){
            // dd($request);
            DB::table('user_akses')->where(['user_akses_id' => $user_akses_id])->update($data);
        }else{
            DB::table('user_akses')->insert($data);
        }
        return Redirect::back()->with(['success' => 'Data Berhasil Di Ubah!']);
    }
}
