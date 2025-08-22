@extends('layouts.vertical', ['title' => 'Komposisi Karyawan'])

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
            <li class="breadcrumb-item active">Human Capital</li>
        </ol>
    </div>
</div><div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Komposisi Karyawan </h5>
            </div>

            <div class="card-body">

                <table  class="table table-bordered dt-responsive table-responsive">
                <thead>
        <tr>
            <th rowspan="2">Deskripsi</th>
            @foreach ($years as $year)
                <th colspan="3" class="text-center">{{ $year }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach ($years as $year)
                <th>Perseroan</th>
                <th>Anak</th>
                <th>Total</th>
            @endforeach
        </tr>
    </thead>
					 <tbody>
        @foreach ($data as $deskripsi => $tahunData)
            <tr>
                <td>{{ $deskripsi }}</td>
                @foreach ($years as $year)
                    <td>{{ $tahunData[$year]['perseroan'] ?? 0 }}</td>
                    <td>{{ $tahunData[$year]['anak'] ?? 0 }}</td>
                    <td>{{ $tahunData[$year]['total'] ?? 0 }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            @foreach ($years as $year)
                <th>{{ $totals[$year]['perseroan'] ?? 0 }}</th>
                <th>{{ $totals[$year]['anak'] ?? 0 }}</th>
                <th>{{ $totals[$year]['total'] ?? 0 }}</th>
            @endforeach
        </tr>
    </tfoot>
    </table>
            </div>
        </div>
    </div>
	</div>
@include('hcdocs.index', ['HC_supportingdoc' => $HC_supportingdoc])

@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
