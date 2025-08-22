@extends('layouts.vertical', ['title' => 'Grievance Rantai Pasok'])

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
        <h4 class="fs-18 fw-semibold m-0">Grievance</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Sustainability</a></li>
            <li class="breadcrumb-item active">Grievance</li>
        </ol>
    </div>
</div>
<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Grievance Rantai Pasok </h5>
            </div>

            <div class="card-body">

    <table class="table table-bordered table-sm align-middle text-left">
        <thead class="table-dark">
            <tr>
                <th>#</th>

            <th>Nama Rantai Pasok</th>
            <th>Tgl Laporan</th>
            <th>Nama PT</th>        
            <th>Jenis Grievance</th>        
            <th>Lokasi</th>        
            <th>Luas (ha)</th>        
            <th>Problem</th>
             <th>Tindak Lanjut</th>
              <th>Status</th>
               <th>Tgl Status</th>
				
            </tr>
        </thead>
        <tbody>
   
                @foreach($data as $index => $row)
                    <tr>

                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->nama_rantai_pasok  }}</td>
                        <td>{{ $row->tanggal_laporan }}</td>
                         <td>{{ $row->nama_pt }}</td>
                        <td>{{ $row->jenis_grievance }}</td>
                        <td>{{ $row->lokasi }}</td>
                        <td>{{ $row->luas_ha }}</td>
                        <td>{{ $row->problem }}</td>
                        <td>{{ $row->tindak_lanjut }}</td>
                        <td>{{ $row->status }}</td>
                        <td>{{ $row->tanggal_status }}</td>

                @endforeach

        </tbody>
    </table>
</div></div></div></div>

@include('documents.indexsja', ['supportingdoc' => $supportingdoc])
@endsection
