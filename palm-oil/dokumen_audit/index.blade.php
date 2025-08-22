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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
    @if(isset($id) && !empty($id))
    @php
        $data = DB::table('kebutuhan_data')->select('jenis_data', 'sub_kategori')->where('id', $id)->first();
        $jenis_data = $data->jenis_data ?? 'Tidak Ada Data';
        $sub_kategori = $data->sub_kategori ?? 'Tidak Ada Kategori';
    @endphp
    <h5 class="card-title mb-0">Dokumen Audit | {{ $sub_kategori }} | Data: {{ $jenis_data }}</h5>
@else
    <h5 class="card-title mb-0">ID tidak ditemukan</h5>
@endif
            </div>
            <div class="card-body">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('palm-oil.dokumen_audit.upload', $id ?? 0) }}" class="btn btn-primary mb-3">Submit Dokumen</a>
    <div class="card-body">

                <table class="table table-bordered dt-responsive table-responsive">
        <thead>
             <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>PT</th> 
                <th>PKS</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Maker</th>
                <th>Checker</th>
                <th>Approver</th>
                <th>View File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dokumen as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_dokumen }}</td>
                    <td>{{ $item->nama_pt }}</td>
                    <td>{{ $item->nama_pks }}</td>
                      <td>{{ $item->kategori }}</td>
                    <td>{{ $item->sub_kategori }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->maker->name ?? 'N/A' }}</td>
                <td>{{ $item->checker->name ?? 'N/A' }}</td>
                <td>{{ $item->approver->name ?? 'N/A' }}</td>    
                <td>
                                <a href="{{ asset('storage/' . $item->path) }}" target="_blank" class="action-btn btn-view">Download</a>

                </td>             
                <td>
                    @if(auth()->user()->role === 'checker' && $item->status === 'draft')
                        <a href="{{ route('palm-oil.dokumen_audit.review', $item->id) }}" class="action-btn btn-review">Review</>
                    @endif
                    @if(auth()->user()->role === 'checker' && $item->status === 'rejected')
    <a href="{{ route('palm-oil.dokumen_audit.review', $item->id) }}" class="btn btn-warning">Review Ulang</a>
@endif
                    @if(auth()->user()->role === 'approver' && $item->status === 'reviewed')
                        <a href="{{ route('palm-oil.dokumen_audit.approve', $item->id) }}" class="action-btn btn-approve">Approv>
                    @endif
                </td>
                </tr>
                      @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada dokumen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>      
        </div>
        </div>
</div>
@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection