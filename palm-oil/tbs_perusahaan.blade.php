@extends('layouts.vertical', ['title' => 'TBS Perusahaan'])

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
        <h4 class="fs-18 fw-semibold m-0">Data Palm Oil</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>
</div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Produksi TBS Bulanan | {{ $perusahaan }}</h5>
            </div>

            <div class="card-body table-responsive">

				  <table  class="table table-bordered dt-responsive">
                  <thead class="table-dark">
            <tr>
                <th rowspan="2">Tahun</th>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                    <th colspan="2">{{ $bulan }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                    <th>Inti</th>
                    <th>Plasma</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($dataProduksiTBS_bulanan as $data)
                <tr>
                    <td>{{ $data->tahun }}</td>
                    @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                        <td>{{ number_format($data->{$bulan . '_inti'}, 0, ',', '.') }}</td>
                        <td>{{ number_format($data->{$bulan . '_plasma'}, 0, ',', '.') }}</td>
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


@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
