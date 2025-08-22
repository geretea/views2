  GNU nano 7.2                               resources/views/palm-oil/ffb_yield_bulanan.blade.php                                        
@extends('layouts.vertical', ['title' => 'Yield TBS'])

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
        <h4 class="fs-18 fw-semibold m-0">Yield TBS</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Kinerja Operasional</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Yield TBS Bulanan {{ $perusahaan }}</h5>
            </div>

            <div class="card-body" style="overflow-x:auto">
<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2">Tahun</th>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November'>
                <th colspan="2" class="text-center">{{ $bulan }}</th>
            @endforeach
        </tr>
        <tr>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November'>

                <th class="text-center">Inti</th>
                <th class="text-center">Plasma</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
           @foreach ($data as $tahun => $items)
            <tr>
                <td>{{ $tahun }}</td>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November'>

                    @php
                        $record = collect($items)->firstWhere('bulan', (int)$bulan);
                    @endphp
                    <td class="text-end">{{ number_format(optional($record)->yield_inti ?? 0, 2, ',', '.') }}</td>
                    <td class="text-end">{{ number_format(optional($record)->yield_plasma ?? 0, 2, ',', '.') }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
