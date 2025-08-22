@extends('layouts.vertical', ['title' => 'FFB Yield'])
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
            <li class="breadcrumb-item active">Update Informasi</li>
        </ol>
    </div>
    </div>
<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header">
                <h5 class="card-title mb-0">Yield TBS Inti dan Plasma </h5>  
            </div>

            <div class="card-body">

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th rowspan="2">Perusahaan</th>
                @foreach ($years as $year)
                    <th colspan="2">{{ $year }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach ($years as $year)
                    <th>Inti</th>
                    <th>Plasma</th>
                @endforeach
            </tr>
        </thead>
        <tbody>  @foreach ($yieldData->groupBy('perusahaan') as $perusahaan => $rows)
                <tr>
                   <td>{{ $perusahaan }}</td>
                    @foreach ($years as $year)
                        @php
                            $row = $rows->firstWhere('tahun', $year);
                        @endphp
                        <td>{{ $row->yield_inti ?? '-' }}</td>
                        <td>{{ $row->yield_plasma ?? '-' }}</td>
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
@include('documents.indexsja', ['supportingdoc' => $supportingdoc])

@endsection

@section('script')
@vite(['resources/js/pages/datatable.init.js'])
@endsection


