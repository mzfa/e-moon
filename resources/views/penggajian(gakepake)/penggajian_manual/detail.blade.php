@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Slip Gaji</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Slip Gaji</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Slip Gaji <a class="btn btn-primary" href="{{ url('slip_gaji/cetak/'.Crypt::encrypt($id)) }}">Cetak</a></h2>
        @php
            $bulan = ['01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni','07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'];
            // dd($bulan[01]);
            $bulan_periode = substr($data->periode_gaji, -2);
            $bulan_fix = $bulan[$bulan_periode];
            $periode_gajian = $bulan_fix." ". substr($data->periode_gaji,0, 4);
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="card border border-info">
                    <div class="card-header bg-info p-1">
                        <div class="col-md-2">
                            <img src="{{ url(env('APP_LOGO_HCM')) }}" class="w-100">
                        </div>
                        <div class="col-md-10" style="font-weight: bold;font-size:100%padding:0 !important;">
                            {{-- <table class="text-white" width="100%">
                                <tr>
                                    <th>Nama</th>
                                    <th>:</th>
                                    <th>{{ 'zul' }}</th>
                                </tr>
                                <tr>
                                    <th>NRp</th>
                                    <th>:</th>
                                    <th>{{ 'zul' }}</th>
                                    <th>Unit Kerja</th>
                                    <th>:</th>
                                    <th>{{ 'zul' }}</th>
                                </tr>
                                <tr>
                                    <th>Kelas Jabaran</th>
                                    <th>:</th>
                                    <th>{{ 'zul' }}</th>
                                    <th>Golongan</th>
                                    <th>:</th>
                                    <th>{{ 'zul' }}</th>
                                </tr>
                                <tr>
                                    <th>Periode</th>
                                    <th>:</th>
                                    <th>{{ 'zul' }}</th>
                                </tr>
                            </table> --}}
                                <div class="row text-white fw-bold">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-3 p-0">Nama</div>
                                            <div class="col-9">: {{ $data->nama }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-white fw-bold">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-3 p-0">NIP</div>
                                            <div class="col-9">: {{ $data->nip }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-3 p-0">Unit Kerja</div>
                                            <div class="col-9">: {{ $data->bagian }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-white fw-bold">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-3 p-0">Jabatan</div>
                                            <div class="col-9">: {{ $data->kelas_jabatan }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-3 p-0">Pendidikan</div>
                                            <div class="col-9">: {{ $data->pendidikan }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-white fw-bold">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-3 p-0">Periode</div>
                                            <div class="col-9">: {{ $periode_gajian }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-3 p-0">Status</div>
                                            <div class="col-9">: {{ $data->status_kepegawaian_manual }}</div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border border-warning">
                                    <div class="card-header bg-warning">
                                        <h5 class="text-white">A. Pendapatan Tetap</h5>
                                    </div>
                                    <div class="card-body">
                                        <table width="100%">
                                            <tr>
                                                <td>Gaji Pokok</td>
                                                <th style="text-align: right">{{ number_format($data->gaji_pokok) }}</th>
                                            </tr>
                                            <tr>
                                                <td>IP</td>
                                                <th style="text-align: right">{{ number_format($data->ip) }}</th>
                                            </tr>
                                            <tr>
                                                <td>Tunjangan Jabatan</td>
                                                <th style="text-align: right">{{ number_format($data->tunj_jabatan) }}</th>
                                            </tr>
                                            @if($data->penyesuaian !== '0' && $data->penyesuaian !== null)
                                            <tr>
                                                <td>Tunjangan Penyesuaian</td>
                                                <th style="text-align: right">{{ number_format($data->penyesuaian) }}</th>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="3"><hr></td>
                                            </tr>
                                            <tr>
                                                {{-- <td>&nbsp;</td> --}}
                                                <th style="text-align: right" colspan="3">Rp. {{ number_format($data->total_gaji) }}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="card border border-success">
                                    <div class="card-header bg-success">
                                        <h5 class="text-white">B. Pendapatan Tidak Tetap</h5>
                                    </div>
                                    <div class="card-body">
                                        <table width="100%">
                                            <tr>
                                                <td>Overtime</td>
                                                <th style="text-align: right">{{ number_format($data->overtime) }}</th>
                                            </tr>
                                            <tr>
                                                <td>Double Job</td>
                                                <th style="text-align: right">{{ number_format($data->double_job) }}</th>
                                            </tr>
                                            <tr>
                                                <td>Rapel</td>
                                                <th style="text-align: right">{{ number_format($data->rapel) }}</th>
                                            </tr>
                                            @if($data->pph_21_dtp !== '0' && $data->pph_21_dtp !== null)
                                            <tr>
                                                <td>PPH 21 DTP</td>
                                                <th style="text-align: right">{{ number_format($data->pph_21_dtp) }}</th>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="3"><hr></td>
                                            </tr>
                                            <tr>
                                                {{-- <td>&nbsp;</td> --}}
                                                <th style="text-align: right" colspan="3">Rp. {{ number_format($data->overtime + $data->double_job + $data->rapel + $data->pph_21_dtp) }}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border border-danger">
                                    <div class="card-header bg-danger">
                                        <h5 class="text-white">C. Jumlah Potongan</h5>
                                    </div>
                                    <div class="card-body">
                                        <table width="100%">
                                            <tr>
                                                <td>BPJS TK</td>
                                                <th style="text-align: right">{{ number_format($data->bpjs_tk) }}</th>
                                            </tr>
                                            <tr>
                                                <td>BPJS Kesehatan</td>
                                                <th style="text-align: right">{{ number_format($data->bpjs_kesehatan) }}</th>
                                            </tr>
                                            <tr>
                                                <td>PPH 21</td>
                                                <th style="text-align: right">{{ number_format($data->pph_21) }}</th>
                                            </tr>
                                            <tr>
                                                <td>Potongan Obat</td>
                                                <th style="text-align: right">{{ number_format($data->pemotongan_obat) }}</th>
                                            </tr>
                                            @if($data->potongan_koperasi !== '0' && $data->potongan_koperasi !== null)
                                            <tr>
                                                <td>Potongan Koperasi</td>
                                                <th style="text-align: right">{{ number_format($data->potongan_koperasi) }}</th>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>Lain-lain</td>
                                                <th style="text-align: right">{{ number_format($data->lain_lain) }}</th>
                                            </tr>
                                            <tr>
                                                <td>Parkir</td>
                                                <th style="text-align: right">{{ number_format($data->parkir) }}</th>
                                            </tr>
                                            <tr>
                                                <td>Pinjaman</td>
                                                <th style="text-align: right">{{ number_format($data->pinjaman) }}</th>
                                            </tr>
                                            <tr>
                                                <td>Kesejahteraan Karyawan</td>
                                                <th style="text-align: right">{{ number_format($data->kesra) }}</th>
                                            </tr>
                                            <tr>
                                                <td>Potongan Absensi</td>
                                                <th style="text-align: right">{{ number_format($data->potongan_absensi) }}</th>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><hr></td>
                                            </tr>
                                            <tr>
                                                {{-- <td>&nbsp;</td> --}}
                                                <th style="text-align: right" colspan="3">Rp. {{ number_format($data->total_pengurang) }}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="card border border-primary">
                                    <div class="card-header bg-primary">
                                        <h5 class="text-white">D. Jumlah Terima</h5>
                                    </div>
                                    <div class="card-body">
                                        <table width="100%">
                                            <tr>
                                                <th><h6 class="text-center">PENDAPATAN TETAP + PENDAPATAN TIDAK TETAP - JUMLAH POTONGAN</h6></th>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><hr></td>
                                            </tr>
                                            <tr>
                                                <th><center><h5 class="text-center ">Rp. {{ number_format($data->gaji_bersih) }}</h5></center></th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
</script>

@endsection