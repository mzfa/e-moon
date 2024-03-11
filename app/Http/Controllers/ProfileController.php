<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::user()->pegawai_id;
        // $data = DB::table('users')
        // ->leftJoin('pegawai', 'users.pegawai_id', '=', 'pegawai.pegawai_id')
        // ->leftJoin('pegawai_detail', 'users.pegawai_id', '=', 'pegawai_detail.pegawai_id')
        // ->leftJoin('bagian', 'pegawai.bagian_id', '=', 'bagian.bagian_id')
        // ->leftJoin('profesi', 'pegawai.profesi_id', '=', 'profesi.profesi_id')
        // ->select([
        //     'users.username',
        //     'pegawai.*',
        //     'pegawai.pegawai_id AS idpeg',
        //     'pegawai_detail.*',
        //     'bagian.nama_bagian',
        //     'profesi.nama_profesi'
        // ])
        // ->whereNull('pegawai.deleted_at')
        // ->where(['id' => $id])
        // ->get();
        $data = DB::table('pegawai')
        ->leftJoin('bagian', 'pegawai.bagian_id', '=', 'bagian.bagian_id')
        ->leftJoin('profesi', 'pegawai.profesi_id', '=', 'profesi.profesi_id')
        ->select([
            'pegawai.*',
            'bagian.nama_bagian',
            'profesi.nama_profesi'
            ])
        ->whereNull('pegawai.deleted_at')
        ->where(['pegawai.pegawai_id' => $id])
        ->first();
        // dd($data);
        if(empty($data)){
            return Redirect::back()->with(['error' => 'Anda belum di daftarkan sebagai pegawai!']);
        }
            // $bagian = DB::table('bagian')->get();
        $jenis_pendidikan = DB::table('jenis_pendidikan')->whereNull('jenis_pendidikan.deleted_at')->get();
        $jenis_pelatihan = DB::table('jenis_pelatihan')->whereNull('jenis_pelatihan.deleted_at')->get();
        $keluarga_pegawai = DB::table('keluarga_pegawai')->where('pegawai_id', $id)->get();
        $pendidikan_pegawai = DB::table('pendidikan_pegawai')->leftJoin('jenis_pendidikan', 'jenis_pendidikan.jenis_pendidikan_id', '=', 'pendidikan_pegawai.jenis_pendidikan_id')->where('pegawai_id', $id)->get();
        return view('profile.index', compact('data', 'keluarga_pegawai','pendidikan_pegawai','jenis_pendidikan','jenis_pelatihan'));
    }

    public function alamat(Request $request){
        // dd($request);
        $pegawai_detail_id = $request->pegawai_detail_id;
        $data = [
            'alamat_lengkap' => $request->alamat_lengkap,
            'provinsi' => $request->provinsi,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'kode_pos' => $request->kode_pos,
            'pegawai_id' => $request->pegawai_id,
        ];
        $cek = DB::table('pegawai_detail')->where(['pegawai_detail_id' => $pegawai_detail_id])->get();
        if(isset($cek[0])){
            DB::table('pegawai_detail')
            ->update(
                $data,
                ['pegawai_detail_id' => $pegawai_detail_id],
            );
        }else{
            DB::table('pegawai_detail')
            ->insert(
                $data
            );
        }
        return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!']);
    }
    public function kontak(Request $request){
        // dd($request);
        $pegawai_detail_id = $request->pegawai_detail_id;
        $pegawai_id = $request->pegawai_id;
        $data = [
            'telp_pribadi' => $request->telp_pribadi,
            'telp_keluarga' => $request->telp_keluarga,
            'pegawai_id' => $request->pegawai_id,
        ];
        $cek = DB::table('pegawai_detail')->where(['pegawai_detail_id' => $pegawai_detail_id])->get();
        if(isset($cek[0])){
            DB::table('pegawai_detail')
            ->update(
                [
                    'telp_pribadi' => $request->telp_pribadi,
                    'telp_keluarga' => $request->telp_keluarga,
                    'pegawai_id' => $request->pegawai_id,
                ],
                ['pegawai_detail_id' => $pegawai_detail_id],
            );
        }else{
            DB::table('pegawai_detail')
            ->insert(
                [
                    'telp_pribadi' => $request->telp_pribadi,
                    'telp_keluarga' => $request->telp_keluarga,
                    'pegawai_id' => $request->pegawai_id,
                ]
            );
        }
        return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!']);
    }
    public function updateProfile(Request $request){
        // dd($request);
        $request->validate([
            'foto_profile' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $pegawai_detail_id = $request->pegawai_detail_id;
        $pegawai_id = $request->pegawai_id;
        $cek = DB::table('pegawai_detail')->where(['pegawai_detail_id' => $pegawai_detail_id])->get();
        if(isset($cek[0])){
            if($request->hasFile('foto_profile')){
                $fileLama = public_path('images/profile/'.$request->image);
                File::delete($fileLama);
                $foto_profile = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('foto_profile')->getClientOriginalName());
                $request->file('foto_profile')->move(public_path('images/profile'), $foto_profile);
                $data = [
                    'foto_profile' => $foto_profile,
                ];
                DB::table('pegawai_detail')
                ->update(
                    $data,
                    ['pegawai_detail_id' => $pegawai_detail_id],
                );
            }
        }else{
            if($request->hasFile('foto_profile')){
                $foto_profile = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('foto_profile')->getClientOriginalName());
                $request->file('foto_profile')->move(public_path('images/profile'), $foto_profile);
                $data = [
                    'foto_profile' => $foto_profile,
                ];
                DB::table('pegawai_detail')
                ->insert(
                    $data
                );
            }
        }
        return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!']);
    }

    public function tambah_keluarga(Request $request){
        $pegawai_id = Crypt::decrypt($request->pegawai_id);
        $data = [
            'created_by' => Auth::user()->id,
            'created_at' => now(),
            'status_keluarga' => $request->status_keluarga,
            'nama_lengkap_kel' => $request->nama_lengkap_kel,
            'tempat_lahir_kel' => $request->tempat_lahir_kel,
            'tanggal_lahir_kel' => $request->tanggal_lahir_kel,
            'pendidikan_terakhir_kel' => $request->pendidikan_terakhir_kel,
            'jk_kel' => $request->jk_kel,
            'golongan_darah_kel' => $request->golongan_darah_kel,
            'no_mr_kel' => $request->no_mr_kel,
            'pegawai_id' => $pegawai_id,
        ];
        // dd($data);
        DB::table('keluarga_pegawai')->insert($data);
        return true;
        // return Redirect('pegawai')->with(['success' => 'Data Berhasil Di Simpan!']);
    }
    public function tambah_pendidikan(Request $request){
        $pegawai_id = Crypt::decrypt($request->pegawai_id);
        $data = [
            'created_by' => Auth::user()->id,
            'created_at' => now(),
            'jenis_pendidikan_id' => $request->jenis_pendidikan,
            'nama_sekolah' => $request->nama_sekolah,
            'tanggal_lulus' => $request->tanggal_lulus,
            'nomor_ijazah' => $request->nomor_ijazah,
            'jurusan' => $request->jurusan,
            'pegawai_id' => $pegawai_id,
        ];
        // dd($data);
        DB::table('pendidikan_pegawai')->insert($data);
        return true;
        // return Redirect('pegawai')->with(['success' => 'Data Berhasil Di Simpan!']);
    }
    public function tambah_pekerjaan(Request $request){
        $pegawai_id = Crypt::decrypt($request->pegawai_id);
        // dd($request);
        $data = [
            'created_by' => Auth::user()->id,
            'created_at' => now(),
            'nama_perusahaan' => $request->nama_perusahaan,
            'bagian' => $request->bagian,
            'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
            'tanggal_keluar_kerja' => $request->tanggal_keluar_kerja,
            'pegawai_id' => $pegawai_id,
        ];
        // dd($data);
        DB::table('riwayat_pekerjaan_pegawai')->insert($data);
        return true;
        // return Redirect('pegawai')->with(['success' => 'Data Berhasil Di Simpan!']);
    }
    public function tambah_pelatihan(Request $request){
        // dd($request->hasFile('bukti_pelatihan'));
        if($request->hasFile('bukti_pelatihan')){
            // $bukti_pelatihan = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('bukti_pelatihan')->getClientOriginalName());
            // dd($bukti_pelatihan);
            // $request->file('bukti_pelatihan')->move(public_path('document/pelatihan/'), $bukti_pelatihan);
            $file = $request->file('bukti_pelatihan');
            if(in_array($file->getClientMimeType(),['image/jpg','image/jpeg','image/png','application/pdf'])){
                $filenamewithextension = $request->file('bukti_pelatihan')->getClientOriginalName();
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                //get file extension
                $extension = $request->file('bukti_pelatihan')->getClientOriginalExtension();
                //filename to store
                $filenametostore = round(microtime(true) * 1000).'-'.$filename.'_'.uniqid().'.'.$extension;
                $hasil = Storage::disk('ftp')->put($filenametostore, fopen($request->file('bukti_pelatihan'), 'r+'));

                // dd($hasil);
                $pegawai_id = Crypt::decrypt($request->pegawai_id);
                $data = [
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                    'jenis_pelatihan_id' => $request->jenis_pelatihan,
                    'nama_pelatihan' => $request->nama_pelatihan,
                    'tanggal_pelatihan' => $request->tanggal_pelatihan,
                    'penyelenggara' => $request->penyelenggara,
                    'jam_pelajaran' => $request->jam_pelajaran,
                    'bukti_pelatihan' => $filenametostore,
                    'pegawai_id' => $pegawai_id,
                ];
                DB::table('pelatihan_pegawai')->insert($data);
                return true;
            }
            dd('File Upload hanya (JPG,JPEG,PNG,PDF)');
            // return 'File Upload hanya (JPG,JPEG,PNG,PDF)';
        }
        dd('File tidak ditemukan');
        // return false;
        // return Redirect('pegawai')->with(['success' => 'Data Berhasil Di Simpan!']);
    }   

    public function update_data_diri(Request $request){
        // dd($request);
        $pegawai_id = Crypt::decrypt($request->pegawai_id);
        $data = [
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
            'nama_pegawai' => $request->nama_pegawai,
            'gelar' => $request->gelar,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'golongan_darah' => $request->golongan_darah,
            'status_kawin' => $request->status_kawin,
            'nik' => $request->nik,
            'npwp' => $request->npwp,
            'str' => $request->str,
            'masa_berlaku_str' => $request->masa_berlaku_str,
            'tanggal_terbit_str' => $request->tanggal_terbit_str,
            'sip' => $request->sip,
            'masa_berlaku_sip' => $request->masa_berlaku_sip,
            'tanggal_terbit_sip' => $request->tanggal_terbit_sip,
            'no_bpjs_kes' => $request->no_bpjs_kes,
            'no_rek_bsi' => $request->no_rek_bsi,
            'covid' => $request->covid,
            'no_bpjs_tk' => $request->no_bpjs_tk,
            'no_mr' => $request->no_mr,
            'email' => $request->email,
        ];
        // dd($data);
        DB::table('pegawai')->where(['pegawai_id' => $pegawai_id])->update($data);
        return true;
        // return Redirect('pegawai')->with(['success' => 'Data Berhasil Di Simpan!']);
    }
    public function update_alamat(Request $request){
        // dd($request);
        $pegawai_id = Crypt::decrypt($request->pegawai_id);
        
        $alamat = $request->alamat;
        $provinsi = $request->provinsi;
        $kota = $request->kota;
        $kecamatan = $request->kecamatan;

        if(isset($request->check_alamat)){
            $alamat = $request->alamat_ktp;
            $provinsi = $request->provinsi_ktp;
            $kota = $request->kota_ktp;
            $kecamatan = $request->kecamatan_ktp;
        }


        $data = [
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
            'telp_pribadi' => $request->telp_pribadi,
            'telp_keluarga' => $request->telp_keluarga,
            'nomor_kontak_darurat' => $request->nomor_kontak_darurat,
            'nama_kontak_darurat' => $request->nama_kontak_darurat,
            'hubungan_kontak_darurat' => $request->hubungan_kontak_darurat,
            'alamat_ktp' => $request->alamat_ktp,
            'provinsi_ktp' => $request->provinsi_ktp,
            'kota_ktp' => $request->kota_ktp,
            'kecamatan_ktp' => $request->kecamatan_ktp,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
        ];
        // dd($data);
        DB::table('pegawai')->where(['pegawai_id' => $pegawai_id])->update($data);
        return true;
        // return Redirect('pegawai')->with(['success' => 'Data Berhasil Di Simpan!']);
    }

    public function table_pendidikan($id){
        $pegawai_id = Crypt::decrypt($id);
        $pendidikan_pegawai = DB::table('pendidikan_pegawai')->leftJoin('jenis_pendidikan', 'jenis_pendidikan.jenis_pendidikan_id', '=', 'pendidikan_pegawai.jenis_pendidikan_id')->whereNull('pendidikan_pegawai.deleted_at')->where('pegawai_id', $pegawai_id)->get();
        return view('table.pendidikan_pegawai', compact('pendidikan_pegawai'));
    }
    
    public function table_keluarga($id){
        $pegawai_id = Crypt::decrypt($id);
        $keluarga_pegawai = DB::table('keluarga_pegawai')->whereNull('keluarga_pegawai.deleted_at')->where('pegawai_id', $pegawai_id)->get();
        return view('table.keluarga_pegawai', compact('keluarga_pegawai'));
    }

    public function table_riwayat_pekerjaan($id){
        $pegawai_id = Crypt::decrypt($id);
        $riwayat_pekerjaan_pegawai = DB::table('riwayat_pekerjaan_pegawai')->whereNull('riwayat_pekerjaan_pegawai.deleted_at')->where('pegawai_id', $pegawai_id)->get();
        return view('table.riwayat_pekerjaan_pegawai', compact('riwayat_pekerjaan_pegawai'));
    }
    public function table_pelatihan($id){
        $pegawai_id = Crypt::decrypt($id);
        $pelatihan_pegawai = DB::table('pelatihan_pegawai')->whereNull('pelatihan_pegawai.deleted_at')->where('pegawai_id', $pegawai_id)->get();
        return view('table.pelatihan_pegawai', compact('pelatihan_pegawai'));
    }

    public function hapus_pendidikan($id){
        $id = Crypt::decrypt($id);
        // if($data = DB::select("SELECT * FROM tbl_menu WHERE menu_id='$id'")){
        //     DB::select("DELETE FROM tbl_menu WHERE menu_id='$id'");
        // }
        $data = [
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now(),
        ];
        DB::table('pendidikan_pegawai')->where(['pendidikan_pegawai_id' => $id])->update($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus!']);
    }

    public function hapus_keluarga($id){
        $id = Crypt::decrypt($id);
        $data = [
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now(),
        ];
        DB::table('keluarga_pegawai')->where(['keluarga_pegawai_id' => $id])->update($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus!']);
    }

    public function hapus_pekerjaan($id){
        $id = Crypt::decrypt($id);
        $data = [
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now(),
        ];
        DB::table('riwayat_pekerjaan_pegawai')->where(['riwayat_pekerjaan_pegawai_id' => $id])->update($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus!']);
    }
    public function hapus_pelatihan($id){
        $id = Crypt::decrypt($id);
        $data = [
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now(),
        ];
        DB::table('pelatihan_pegawai')->where(['pelatihan_pegawai_id' => $id])->update($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus!']);
    }
}
