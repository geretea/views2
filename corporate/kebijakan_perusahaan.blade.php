@extends('layouts.vertical', ['title' => 'Kebijakan Perusahaan'])

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
        <h4 class="fs-18 fw-semibold m-0">Kebijakan Perusahaan</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Corporate</a></li>
            <li class="breadcrumb-item active">Informasi Corporate</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Kebijakan Perusahaan</h5>
            </div>

            <div class="card-body">
@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.kebijakan_perusahaan.index') }}" class="btn btn-primary mb-3">Edit/Update Kebijakan</a>
 @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Kebijakan</th>
                <th>Kategori</th>
                <th>Tanggal Kebijakan</th>
                 <th>Tanggal Amandemen</th>
				  <th>File (Bhs Indonesia)</th>
                <th>File (English)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama_kebijakan }}</td>
                    <td>{{ $row->kategori }}</td>
                     <td>{{ $row->tanggal_kebijakan }}</td>
                    <td>{{ $row->tanggal_submit }}</td>
<td>
    @if ($row->file_id)
        <a href="{{ asset('storage/' . $row->file_id) }}" target="_blank">
            View File 
        </a>
    @else
        <em>Tidak ada file</em>
    @endif
</td>
<td>
    @if ($row->file_eng)
        <a href="{{ asset('storage/' . $row->file_eng) }}" target="_blank">
            View File    </a>
    @else
        <em>Tidak ada file</em>
    @endif
</td>

                </tr>
            @empty
                <tr>
                    <td colspan="5"><em>Belum ada data penghargaan.</em></td>
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