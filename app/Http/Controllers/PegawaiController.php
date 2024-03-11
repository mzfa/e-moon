<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ExportUsers;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = DB::table('pegawai')
        ->leftJoin('bagian', 'pegawai.bagian_id', '=', 'bagian.bagian_id')
        ->leftJoin('profesi', 'pegawai.profesi_id', '=', 'profesi.profesi_id')
        ->leftJoin('pegawai_detail', 'pegawai.pegawai_id', '=', 'pegawai_detail.pegawai_id')
        ->leftJoin('struktur', 'pegawai.struktur_id', '=', 'struktur.struktur_id')
        ->select([
            'pegawai.*',
            'struktur.nama_struktur',
            'bagian.nama_bagian',
            'profesi.nama_profesi'
        ])
        ->whereNull('pegawai.deleted_at')
        ->get();
        return view('pegawai.index', compact('data'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data = DB::table('pegawai')
        ->leftJoin('bagian', 'pegawai.bagian_id', '=', 'bagian.bagian_id')
        ->leftJoin('profesi', 'pegawai.profesi_id', '=', 'profesi.profesi_id')
        ->select([
            'pegawai.*',
            // 'pegawai.pegawai_id',
            'bagian.nama_bagian',
            'profesi.nama_profesi'
            ])
        ->whereNull('pegawai.deleted_at')
        ->where(['pegawai.pegawai_id' => $id])
        ->first();
        // dd($data);
        // $bagian = DB::table('bagian')->get();
        $jenis_pendidikan = DB::table('jenis_pendidikan')->whereNull('jenis_pendidikan.deleted_at')->get();
        $struktur = DB::table('struktur')->whereNull('struktur.deleted_at')->get();
        $grup_kepegawaian = DB::table('grup_kepegawaian')->whereNull('grup_kepegawaian.deleted_at')->get();
        $jenis_pelatihan = DB::table('jenis_pelatihan')->whereNull('jenis_pelatihan.deleted_at')->get();
        $keluarga_pegawai = DB::table('keluarga_pegawai')->where('pegawai_id', $id)->get();
        $pendidikan_pegawai = DB::table('pendidikan_pegawai')->leftJoin('jenis_pendidikan', 'jenis_pendidikan.jenis_pendidikan_id', '=', 'pendidikan_pegawai.jenis_pendidikan_id')->where('pegawai_id', $id)->get();
        // $provinsi = DB::table('pegawai_detail')->distinct()->get(['provinsi']);
        // $kabupaten = DB::table('pegawai_detail')->distinct()->get(['kabupaten']);
        // $data = DB::select("SELECT * FROM pegawai WHERE pegawai_id='$id'");
        return view('pegawai.edit', compact('data', 'keluarga_pegawai','pendidikan_pegawai','jenis_pendidikan','jenis_pelatihan','struktur','grup_kepegawaian'));
    }

    public function add()
    {
        $struktur = DB::table('struktur')->get();
        $bagian = DB::table('bagian')->get();
        $profesi = DB::table('profesi')->get();
        return view('pegawai.add', compact('struktur','bagian','profesi'));
    }

    public function store(Request $request){
        $no_urut = DB::table('pegawai')->max('no_urut')+1;
        $pegawai_id = DB::table('pegawai')->max('pegawai_id')+1;
        $tgl = substr($request->tanggal_lahir,2,5);
        // dd($tgl);
        $nip = $no_urut . str_replace("-","", $tgl);
        $data = [
            'pegawai_id' => $pegawai_id,
            'created_by' => Auth::user()->id,
            'created_at' => now(),
            'nama_pegawai' => $request->nama_pegawai,
            'gelar' => $request->gelar,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'email' => $request->email,
            'bagian_id' => $request->bagian_id,
            'profesi_id' => $request->profesi_id,
            'struktur_id' => $request->struktur_id,
            'no_urut' => $no_urut,
            'nip' => $nip,
        ];
        // dd($nip);
        DB::table('pegawai')->insert($data);
        $dataa = [
            'pegawai_id' => $pegawai_id,
            'struktur_id' => $request->struktur_id,
        ];
        DB::table('pegawai_detail')->insert($dataa);
        // return true;
        return Redirect('pegawai')->with(['success' => 'Data Berhasil Di Simpan!']);
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
            // dd('ok');
            // $bukti_pelatihan = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('bukti_pelatihan')->getClientOriginalName());
            // dd($bukti_pelatihan);
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
                // $request->file('bukti_pelatihan')->move(public_path('document/pelatihan/'), $bukti_pelatihan);
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
            return false;
        }
        return false;
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
            'no_bpjs_tk' => $request->no_bpjs_tk,
            'no_mr' => $request->no_mr,
            'email' => $request->email,
            'no_rek_bsi' => $request->no_rek_bsi,
            'covid' => $request->covid,
            'tanggal_masuk' => $request->tanggal_masuk,
            'struktur_id' => $request->struktur_id,
            'grup_kepegawaian_id' => $request->grup_kepegawaian_id,
        ];
        // dd($data);
        DB::table('pegawai')->where(['pegawai_id' => $pegawai_id])->update($data);
        $dataa = [
            'pegawai_id' => $pegawai_id,
            'struktur_id' => $request->struktur_id,
        ];
        if($pegdet = DB::table('pegawai_detail')->where('pegawai_id', $pegawai_id)->first()){
            DB::table('pegawai_detail')->where(['pegawai_id' => $pegawai_id])->update($dataa);
        }else{
            DB::table('pegawai_detail')->insert($dataa);
        }
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

    public function export(){
        // $data       = DB::table('pegawai')->get()->toArray();
        // // $dataHeader       = DB::connection()->getDoctrineSchemaManager()->listTableIndexes('pegawai');
        // // dd($dataHeader);
        // // $dataHeader = array_keys($data[0]);
        // // $dataHeader = json_decode($data[0], true);
        // $filename   = 'data-film-export.xlsx';
        // try {
        //     Excel::store(new ExcelExport($data, 'main'), $filename, 'public');

        //     return response()->download(storage_path('app\public\\' . $filename));
        // } catch (\Exception $e) {
        //     return $e;
        // }
        return Excel::download(new ExportUsers, 'users.xlsx');
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
    public function hapus_pegawai($id){
        $id = Crypt::decrypt($id);
        $data = [
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now(),
        ];
        DB::table('pegawai')->where(['pegawai_id' => $id])->update($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus!']);
    }

    public function cek_satusehat($id){
        $id = Crypt::decrypt($id);

        $data = DB::table('pegawai')->whereNull('pegawai.deleted_at')->where('pegawai_id', $id)->first();

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => env('BASE_URL_SATU_SEHAT').'practitioner/cari',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('nik' => $data->nik),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response);
        // dd('ok',$response,$res);
        $res = json_decode($res);
        if(empty($res->entry[0]->resource->id)){
            dd($response,$res);
        }
        $satusehat_id = $res->entry[0]->resource->id;
        // dd($satusehat_id);

        $data = [
            'satusehat_id' => $satusehat_id,
        ];
        DB::table('pegawai')->where(['pegawai_id' => $id])->update($data);
        return Redirect::back()->with(['success' => 'Data Satu sehat berhasil diperbarui!']);
    }

    public function sync_satusehat(){

        $data = DB::table('pegawai')->whereNull('pegawai.deleted_at')->whereNull('pegawai.satusehat_id')->whereNotNull('pegawai.nik')->get();
        // $datanya = [];
        foreach($data as $item){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('BASE_URL_SATU_SEHAT').'practitioner/cari',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('nik' => $item->nik),
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
            $res = json_decode($response);
            // dd('ok',$response,$res);
            $res = json_decode($res);
            if(empty($res->entry[0]->resource->id)){
                // $satusehat_id = null;
            }else{
                $satusehat_id = $res->entry[0]->resource->id;
                $datanya = [
                    'satusehat_id' => $satusehat_id
                ];
                $datanya2 = [
                    'nik' => $item->nik,
                    'id_satu_sehat' => $satusehat_id
                ];
                DB::connection('PHIS-V2')->table('pegawai')->where(['pegawai_id' => $item->pegawai_id])->update($datanya2);
                DB::table('pegawai')->where(['pegawai_id' => $item->pegawai_id])->update($datanya);
                sleep(0.5);
            }
        }

        // dd($datanya);

        return Redirect::back()->with(['success' => 'Data Satu sehat berhasil diperbarui!']);
    }

    public function sync()
    {
        // dd("ok");
        $list_pegawai_phis = DB::connection('PHIS-V2')
        ->table('pegawai')
        ->select([
            'pegawai_id',
            'input_time',
            'input_user_id',
            'mod_time',
            'mod_user_id',
            'status_batal',
            'nama_pegawai',
            'nip',
            'bagian_id',
            'profesi_id'
        ])
        ->orderBy('pegawai_id')
        ->get();
        // dd($list_pegawai_phis);

        foreach ($list_pegawai_phis as $pegawai) {
            if ($pegawai->status_batal) {
                $deleted_at = $pegawai->mod_time ?? now();
                $deleted_by = $pegawai->mod_user_id ?? 1;
            } else {
                $deleted_at = null;
                $deleted_by = null;
            }
            $datanya[] = [
                'pegawai_id' => $pegawai->pegawai_id,
                'created_at' => $pegawai->input_time,
                'created_by' => $pegawai->input_user_id,
                'updated_at' => $pegawai->mod_time,
                'updated_by' => $pegawai->mod_user_id,
                'deleted_at' => $deleted_at,
                'deleted_by' => $deleted_by,
                'nama_pegawai' => $pegawai->nama_pegawai,
                'nip' => $pegawai->nip,
                'bagian_id' => $pegawai->bagian_id,
                'profesi_id' => $pegawai->profesi_id
            ];
        }
        // dd($datanya);
        DB::table('pegawai')->upsert($datanya, 'pegawai_id');
        // DB::table('pegawai')->truncate();
        // $data = DB::table('pegawai')->insert($datanya);

        return Redirect::back()->with(['success' => 'Data Berhasil Di Perbarui!']);

        // return redirect()->back()->with('status', ['success', 'Data berhasil disimpan']);
    }
}
