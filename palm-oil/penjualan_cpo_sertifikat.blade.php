@extends('layouts.vertical', ['title' => 'Penjualan CPO Bersertifikat'])
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
        <h4 class="fs-18 fw-semibold m-0">Penjualan CPO</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Kinerja Operasional</li>
        </ol>
    </div>
    </div>
<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header">
                <h5 class="card-title mb-0">Volume Penjualan CPO (CSPO & Konvensional) </h5>  
            </div>

            <div class="card-body">

 <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Skema Penjualan</th>
                <th>Satuan</th>
                @foreach($years as $y)
                    <th>{{ $y }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{-- Bagian CSPO --}}
            <tr>
                <td colspan="{{ count($years) + 2 }}" class="text-start fw-bold bg-light">CSPO</td>
            </tr>
            @foreach($data->where('kategori', 'CSPO') as $row)
            <tr>
                <td class="text-start">{{ $row->skema_penjualan }}</td>
                <td>Ton</td>
                @foreach($years as $y)
                    <td>{{ number_format($row->$y, 0, ',', '.') }}</td>
                @endforeach
            </tr>
            @endforeach
            <tr class="fw-bold">
                <td class="text-start">{{ $subtotalCSPO->skema_penjualan }}</td>
                <td>Ton</td>
                @foreach($years as $y)
                    <td>{{ number_format($subtotalCSPO->$y, 0, ',', '.') }}</td>
                @endforeach
            </tr>

            {{-- Bagian Non CSPO --}}
            <tr>
                <td colspan="{{ count($years) + 2 }}" class="text-start fw-bold bg-light">Skema Konvensional (Non-CSPO)</td>
            </tr>
            @foreach($data->where('kategori', 'Non CSPO') as $row)
            <tr>
                <td class="text-start">{{ $row->skema_penjualan }}</td>
                <td>Ton</td>
                @foreach($years as $y)
                    <td>{{ number_format($row->$y, 0, ',', '.') }}</td>
                @endforeach
            </tr>
            @endforeach
            <tr class="fw-bold ">
                <td class="text-start">{{ $subtotalNon->skema_penjualan }}</td>
                <td>Ton</td>
                @foreach($years as $y)
                    <td>{{ number_format($subtotalNon->$y, 0, ',', '.') }}</td>
                @endforeach
            </tr>

            {{-- Total --}}
            <tr class="fw-bold table-light">
                <td class="text-start">{{ $total->skema_penjualan }}</td>
                <td>Ton</td>
                @foreach($years as $y)
                    <td >{{ number_format($total->$y, 0, ',', '.') }}</td>
                @endforeach
            </tr>
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


