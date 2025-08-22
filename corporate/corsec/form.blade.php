
<div class="mb-3">
    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
    <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" value="{{ $dokumen->nama_dokumen ?? '' }}">
</div>
<div class="mb-3">
    <label for="nama_pt" class="form-label">Nama PT</label>
    <input type="text" name="nama_pt" id="nama_pt" class="form-control" value="{{ $dokumen->nama_pt ?? '' }}">
</div>
<div class="mb-3">
    <label for="nama_pks" class="form-label">Nama PKS</label>
    <input type="text" name="nama_pks" id="nama_pks" class="form-control" value="{{ $dokumen->nama_pks ?? '' }}">
</div>
<div class="mb-3">
    <label for="kategori" class="form-label">Kategori</label>
    <input type="text" name="kategori" id="kategori" class="form-control" value="{{ $dokumen->kategori ?? '' }}">
</div>
<div class="mb-3">
    <label for="sub_kategori" class="form-label">Sub Kategori</label>
    <input type="text" name="sub_kategori" id="sub_kategori" class="form-control" value="{{ $dokumen->sub_kategori ?? '' }}">
</div>
<div class="mb-3">
    <label for="tahun" class="form-label">Tahun</label>
    <input type="number" name="tahun" id="tahun" class="form-control" value="{{ $dokumen->tahun ?? '' }}">
</div>
<div class="mb-3">
    <label for="nama_file" class="form-label">File</label>
    <input type="file" name="nama_file" id="nama_file" class="form-control">
    @if(isset($dokumen) && $dokumen->nama_file)
        <p>File saat ini: {{ $dokumen->nama_file }}</p>
    @endif
</div>
<div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
    <textarea name="keterangan" id="keterangan" class="form-control">{{ $dokumen->keterangan ?? '' }}</textarea>
</div>
