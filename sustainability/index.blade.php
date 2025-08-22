@extends('layouts.vertical', ['title' => 'Kebutuhan Data'])

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
        <h4 class="fs-18 fw-semibold m-0">Kebutuhan Data</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Kebutuhan Data</li>
        </ol>
    </div>
</div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Sustainability</h5>
            </div>

            <div class="card-body">
@php
$data = App\Models\Data::where('kategori', 'sustainability')
                                ->get();
@endphp

                <table id="datatable" class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SBU</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th>User</th>
                            <th>Tujuan Laporan</th>
                            <th>Jenis Data</th>
                           <th>Penyedia Data</th>
                        </tr>
                    </thead>
					<tbody>

        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->sbu }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->sub_kategori }}</td>
				<td>{{ $item->user }}</td>
                <td>{{ $item->tujuan_laporan }}</td>
                <td>{{ $item->jenis_data }}</td>
                <td>{{ $item->penyedia_data }}</td>
            </tr>
        @endforeach
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
