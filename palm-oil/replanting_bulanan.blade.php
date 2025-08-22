@extends('layouts.vertical', ['title' => 'Lahan Konservasi'])

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
        <h4 class="fs-18 fw-semibold m-0">Replanting</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Replanting</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Replanting Bulanan Tahun {{ $tahun }}</h5>
            </div>

            <div class="card-body">
@php
$namaBulan = [
    '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
    '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
    '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des',
];
@endphp
                <table  class="table table-bordered dt-responsive table-responsive">
      <thead>
        <tr class="table-primary">
            <th>Kegiatan</th>
            @foreach ($bulanList as $bln)
                <th>{{ $namaBulan[$bln] }}</th>
            @endforeach
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($kegiatan as $label => $nilai)
<tr>
    <td>{{ ucwords(str_replace('_', ' ', $label)) }}</td>
    @foreach ($bulanList as $bln)
        <td style="text-align: right">
            {{ is_numeric($nilai[$bln]) ? number_format($nilai[$bln], 0, ',', '.') : $nilai[$bln] }}
        </td>
    @endforeach
    <td style="text-align: right">
        {{ is_numeric($nilai['total']) ? number_format($nilai['total'], 0, ',', '.') : $nilai['total'] }}
    </td>
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
