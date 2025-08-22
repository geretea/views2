@extends('layouts.vertical', ['title' => 'Penghargaan'])

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
        <h4 class="fs-18 fw-semibold m-0">Penghargaan</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Corporate</a></li>
            <li class="breadcrumb-item active">Penghargaan</li>
        </ol>
    </div>
</div>
<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Penghargaan Korporat</h5>
            </div>

            <div class="card-body">
@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.penghargaan.index') }}" class="btn btn-primary mb-3">Tambah Penghargaan</a>
 @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Penghargaan</th>
                <th>Lembaga Pemberi</th>
                <th>Deskripsi</th>
                <th>File</th>
				            </tr>
        </thead>
        <tbody>
            @forelse ($list as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama_penghargaan }}</td>
                    <td>{{ $row->lembaga_pemberi }}</td>
                    <td>{{ $row->deskripsi }}</td>
                    <td>
                        @if ($row->files && count($row->files))
                            <ul>
                                @foreach ($row->files as $file)
                                    <li>
                                        <a href="{{ asset('storage/penghargaan/' . $file->filename) }}" target="_blank">
                                            📎 {{ $file->filename }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <em>Tidak ada file</em>
                        @en          </td>
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
						