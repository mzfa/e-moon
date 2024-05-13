<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Nama lokasi</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" value="{{ $data->nama_lokasi }}" required>
    </div>
</div>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Akronim (Singkatan)</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="akronim" name="akronim" value="{{ $data->akronim }}" required>
    </div>
</div>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Referensi Bagian</label>
    <div class="col-sm-10">
    <select class="form-control" name="parent_id">
        <option value="0">Rumah Sakit</option>
        @foreach($lokasi as $item)
            <option value="{{ $item->lokasi_id }}" @if($item->lokasi_id == $data->parent_id) selected @endif>{{ $item->nama_lokasi }}</option>
        @endforeach
    </select>
    </div>
    <input type="hidden" name="satusehat_id" value="{{ $data->satusehat_id }}">
</div>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Struktur</label>
    <div class="col-sm-10">
    <select class="form-control" name="struktur_id">
        @foreach($struktur as $item)
            <option value="{{ $item->satusehat_id.'|'.$item->struktur_id }}" @if($item->struktur_id == $data->parent_id) selected @endif>{{ $item->nama_struktur }}</option>
        @endforeach
    </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Keterangan Lokasi</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="keterangan_lokasi" name="keterangan_lokasi" value="{{ $data->keterangan_lokasi }}" required>
    </div>
</div>
<input type="hidden" class="form-control" id="lokasi_id" name="lokasi_id" value="{{ Crypt::encrypt($data->lokasi_id) }}" required>