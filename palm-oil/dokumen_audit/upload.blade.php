@extends('layouts.vertical', ['title' => 'Dokumen Audit'])

@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
        'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
        'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'
    ])
@endsection

@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Palm Oil</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Data</a></li>
            <li class="breadcrumb-item active">Dokumen Audit</li>
        </ol>
    </div>
</div>
<!-- Tabel -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                     @php
    $jenis_data = DB::table('kebutuhan_data')->where('id', $id)->value('jenis_data');
    @endphp
                <h5 class="card-title mb-0">Update Dokumen {{ $jenis_data }}</h5>
            </div>
<div class="card-body">
    <form action="{{ route('palm-oil.dokumen_audit.upload', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_dokumen" value="{{ $id }}">

        <div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
    <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control"> 
</div>
<div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
<label for="nama_pt" class="form-label">Nama PT</label>
    <input type="text" name="nama_pt" id="nama_pt" class="form-control"> 
</div>
<div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
<label for="nama_pks" class="form-label">Nama PKS</label>
   <input type="text" name="nama_pks" id="nama_pks" class="form-control"> 
</div>
<div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
<label for="kategori" class="form-label">Kategori</label>
    <input type="text" name="kategori" id="kategori" class="form-control">
</div>
<div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
<label for="sub_kategori" class="form-label">Sub Kategori</label>
    <input type="text" name="sub_kategori" id="sub_kategori" class="form-control">
</div>
<div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
<label for="tahun" class="form-label">Tahun</label>
    <input type="number" name="tahun" id="tahun" class="form-control">
</div>
<div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
<label for="nama_file" class="form-label">File</label>
    <input type="file" name="nama_file" id="nama_file" class="form-control">

</div>
<div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
<label for="keterangan" class="form-label">Keterangan</label>
    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        <button type="submit" class="btn btn-success">Update</button>
                </div>
    </form>
      </div>
</div>
       </div>
        </div>
@endsection
@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
