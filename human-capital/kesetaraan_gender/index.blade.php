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
            <th rowspan="2">Level Jabatan</th>

            <th colspan="4">2023</th>
            <th colspan="4">2024</th>
       
        </tr>
        <tr>
            <th>Laki-laki</th><th>%</th>
            <th>Perempuan</th><th>%</th>
            <th>Laki-laki</th><th>%</th>
            <th>Perempuan</th><th>%</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($levelJabatan as $level)
            <tr>
                <td>{{ $level }}</td>

                {{-- 2023 Laki-laki --}}
                <td>{{ $data2023[$level]['laki']['jumlah'] ?? 0 }}</td>
                <td>{{ $data2023[$level]['laki']['persentase'] ?? 0 }}%</td>

                {{-- 2023 Perempuan --}}
                <td>{{ $data2023[$level]['perempuan']['jumlah'] ?? 0 }}</td>
                <td>{{ $data2023[$level]['perempuan']['persentase'] ?? 0 }}%</td>

                {{-- 2024 Laki-laki --}}
                <td>{{ $data2024[$level]['laki']['jumlah'] ?? 0 }}</td>
                <td>{{ $data2024[$level]['laki']['persentase'] ?? 0 }}%</td>

                {{-- 2024 Perempuan --}}
                <td>{{ $data2024[$level]['perempuan']['jumlah'] ?? 0 }}</td>
                <td>{{ $data2024[$level]['perempuan']['persentase'] ?? 0 }}%</td>
            </tr>
        @endforeach

        {{-- Baris Total --}}
        <tr style="font-weight: bold;">
            <td>Total</td>
            <td>{{ $data2023['total']['laki'] ?? 0 }}</td>
            <td>100%</td>
            <td>{{ $data2023['total']['perempuan'] ?? 0 }}</td>
            <td>100%</td>
            <td>{{ $data2024['total']['laki'] ?? 0 }}</td>
            <td>100%</td>
            <td>{{ $data2024['total']['perempuan'] ?? 0 }}</td>
            <td>100%</td>
        </tr>
    </tbody>
                 
</table>
			
            </div>
        </div>
    </div>
</div>


@endsection

