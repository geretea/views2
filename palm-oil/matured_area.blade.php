@extends('layouts.vertical', ['title' => 'Mature Area'])
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
        <h4 class="fs-18 fw-semibold m-0">Area Statement</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Update Informasi</li>
        </ol>
    </div>
    </div>
    <!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header">
                <h5 class="card-title mb-0">Matured Area </h5>  
            </div>

            <div class="card-body" style="overflow-x: auto;">

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th rowspan="2">Perusahaan</th>
            <th rowspan="2">Area</th>
            @foreach ($tahunRange as $tahun)
                <th colspan="3" class="text-center">{{ $tahun }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach ($tahunRange as $tahun)
                <th>Inti</th>
                <th>Plasma</th>
                <th>Total</th>
            @endforeach
        </tr>
          </thead>
    <tbody>


@php
    $grandTotals = [];
    foreach ($tahunRange as $tahun) {
        $grandTotals[$tahun] = ['inti' => 0, 'plasma' => 0, 'total' =>0];
    }
@endphp

@foreach ($data as $key => $rows)
    @php
        [$perusahaan, $area] = explode('|', $key);
        $totals = ['inti' => 0, 'plasma' => 0, 'total' => 0];
        $groupedByYear = $rows->keyBy('tahun');
    @endphp
    <tr>
        <td><a href="{{ route('palm-oil.matured_area_pt', ['id' => $id, 'perusahaan' => $perusahaan]) }}">
{{ $perusahaan }}</a></td>
        <td>{{ $area }}</td>
        @foreach ($tahunRange as $tahun)
            @php
                $row = $groupedByYear->get($tahun);
                $inti = $row->mature_area_inti ?? 0;
                $plasma = $row->mature_area_plasma ?? 0;
                $total = $inti + $plasma;
                $totals['inti'] += $inti;
                $totals['plasma'] += $plasma;
                $totals['total'] += $total;
                $grandTotals[$tahun]['inti'] += $inti;
                $grandTotals[$tahun]['plasma'] += $plasma;
                 $grandTotals[$tahun]['total'] += $total;
            @endphp
            <td>{{ number_format($inti, 0, ',', '.') }}</td>
            <td>{{ number_format($plasma, 0, ',', '.') }}</td>
            <td><strong>{{ number_format($total, 0, ',', '.') }}</strong></td>
        @endforeach
    </tr>
@endforeach

<!-- Grand Total -->

<tfoot>
    <tr>
        <th colspan="2">Grand Total</th>
        @foreach ($tahunRange as $tahun)
            <th>{{ number_format($grandTotals[$tahun]['inti'], 0, ',', '.') }}</th>
            <th>{{ number_format($grandTotals[$tahun]['plasma'], 0, ',', '.') }}</th>
            <th>{{ number_format($grandTotals[$tahun]['total'], 0, ',', '.') }}</th>
        @endforeach
    </tr>
</tfoot>
    </tbody>
</table>

            </div>
        </div>
    </div>
</div>
@include('documents.indexsja', ['supportingdoc' => $supportingdoc])

@endsection

@section('script')
@vite(['resources/js/pages/datatable.init.js'])
@endsection