@extends('layouts.vertical', ['title' => 'Dokumen Pajak'])

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
        <h4 class="fs-18 fw-semibold m-0">Corporate</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Data</a></li>
            <li class="breadcrumb-item active">Pajak</li>
        </ol>
    </div>
</div>

<!-- Tabel -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            @php
    $jenis_data = DB::table('kebutuhan_data')->where('id', $id)->value('jenis_data');
    @endphp
                <h5 class="card-title mb-0">Dokumen Pajak {{ $jenis_data }}</h5>
            </div>
            <div class="card-body">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('corporate.pajak.upload', $id ?? 0) }}" class="btn btn-primary mb-3">Tambah Dokumen</a>
    <div class="card-body">

                <table class="table table-bordered dt-responsive table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>PT</th>
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
                        <a href="{{ route('corporate.pajak.review', $item->id) }}" class="action-btn btn-review">Review</a>
                    @endif
                    @if(auth()->user()->role === 'checker' && $item->status === 'rejected')
    <a href="{{ route('corporate.pajak.review', $item->id) }}" class="btn btn-warning">Review Ulang</a>
@endif
                    @if(auth()->user()->role === 'approver' && $item->status === 'review')
                        <a href="{{ route('corporate.pajak.approve', $item->id) }}" class="action-btn btn-approve">Approve</a>
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