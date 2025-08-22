@extends('layouts.vertical', ['title' => 'Edit Sertifikasi Kebun'])

@section('content')

<div class="py-3">
    <h4 class="fs-18 fw-semibold">Edit Sertifikasi Kebun</h4>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('palm-oil.sertifikasi_kebun.update', $sertifikasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tipe Sertifikat</label>
                <input type="text" name="tipe_sertifikat" class="form-control" value="{{ $sertifikasi->tipe_sertifikat }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="{{ $sertifikasi->penerbit }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">No. Sertifikat</label>
                <input type="text" name="no_sertifikat" class="form-control" value="{{ $sertifikasi->no_sertifikat }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Periode</label>
                <div class="d-flex gap-2">
                    <input type="date" name="tgl_berlaku" class="form-control" value="{{ $sertifikasi->tgl_berlaku }}" required>
                    <span class="align-self-center">-</span>
                    <input type="date" name="tgl_berakhir" class="form-control" value="{{ $sertifikasi->tgl_berakhir }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Unit</label>
                <input type="number" name="jumlah_unit" class="form-control" value="{{ $sertifikasi->jumlah_unit }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Luasan</label>
                <input type="number" name="jumlah_luasan" class="form-control" value="{{ $sertifikasi->jumlah_luasan }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kebun Pemasok</label>
                <input type="text" name="kebun_pemasok" class="form-control" value="{{ $sertifikasi->kebun_pemasok }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload File Sertifikat (PDF, JPG, PNG)</label>
                <input type="file" name="file" class="form-control">
                @if ($sertifikasi->file_path)
                    <p class="mt-2">
                        <a href="{{ asset('storage/' . $sertifikasi->file_path) }}" target="_blank">Lihat File Saat Ini</a>
                    </p>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('palm-oil.sertifikasi_kebun') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection
