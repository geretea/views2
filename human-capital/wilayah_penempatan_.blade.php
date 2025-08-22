@extends('layouts.vertical', ['title' => 'Kesetaran Gender'])

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
        <h4 class="fs-18 fw-semibold m-0">Human Capital</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Human Capital</a></li>
            <li class="breadcrumb-item active">Kesetaraan Gender</li>
        </ol>
    </div>
</div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Kesetaraan Gender</h5>
            </div>

            <div class="card-body">


                <table class="table table-bordered dt-responsive table-responsive">
                    
    <thead>
        <tr>
            <th rowspan="2">Wilayah</th>
            @foreach([2024, 2023, 2022] as $tahun)
                <th colspan="3">{{ $tahun }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach([2024, 2023, 2022] as $tahun)
                <th>Laki-laki</th>
                <th>Perempuan</th>
                <th>Jumlah</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row['wilayah'] }}</td>
                @foreach([2024, 2023, 2022] as $tahun)
                    <td>{{ $row[$tahun]['laki'] ?? '-' }}</td>
                    <td>{{ $row[$tahun]['perempuan'] ?? '-' }}</td>
                    <td>{{ $row[$tahun]['jumlah'] ?? '-' }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

			
            </div>
        </div>
    </div>
</div>


@endsection

