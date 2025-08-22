@extends('layouts.vertical', ['title' => 'Pelatihan Board'])

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
        <h4 class="fs-18 fw-semibold m-0">Data HC</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Data</a></li>
            <li class="breadcrumb-item active">Pelatihan</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
		
                <h5 class="card-title mb-0">Data Pelatihan (Tahun {{ $tahunTerakhir }}) </h5>
            </div>

            <div class="card-body">
<table class="table table-bordered dt-responsive table-responsive">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Judul Pelatihan</th>
            <th>Tempat</th>
            <th>Penyelenggara</th>
                <th>Durasi (Jam)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pelatihan as $nama => $data)
            @foreach($data as $item)

                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->jenis_pelatihan }}</td>
                    <td>{{ $item->tempat ?? 'N/A' }}</td>
                    <td>{{ $item->penyelenggara ?? 'N/A' }}</td>
                        <td>{{ $item->durasi }}</td>
                </tr>
            @endforeach
                <tr class="table-info">
                    <td colspan="5" class="text-first"><strong>Total Durasi untuk {{ $nama }}:</strong></td>
                    <td><strong>{{ $totalDurasi[$nama] ?? 0 }} Jam</strong></td>
                </tr>
        @endforeach
    </tbody>
        <tfoot>
            <tr class="table-warning">
				
                <td colspan="5" class="text-first"><strong>Total Seluruh Pelatihan :</strong></td>
                <td><strong>{{ $totalDurasiKeseluruhan }} Jam</strong></td>
            </tr>
        </tfoot>
</table>
				
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
