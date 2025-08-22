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
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">Program Replanting (SWA) </h5>  
 <span class="btn btn-outline-primary">
        Klik Tahun untuk melihat data bulanan per tahun.
    </span>
            </div>

            <div class="card-body">

                <table  class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr class="table-primary">
                            <th >Tahun</th>
                <th colspan="3">Tumbang</th>
                <th colspan="3">Tanam LCC</th>
                <th colspan="3">Tanam KS</th>

                       
                        </tr>
						
						 <tr class="table-active">
            <th></th>
            @foreach($years as $year)
                <th>Plan (Ha) </th>
                <th>Aktual (Ha) </th>
                <th>Achievement (%) </th>

            @endforeach
        </tr>
    </thead>
    <tbody>
      
@foreach ($dataReplanting as $item)
    <tr>
        <td> <a href="{{ route('palm-oil.replanting_bulanan', ['id' => $id, 'tahun' => $year]) }}"> {{ $item->tahun }}
    </a></td>
<td>{{ number_format($item->total_plan_tumbang, 0, ',', '.') }}</td>
<td>{{ number_format($item->total_aktual_tumbang, 0, ',', '.') }}</td>
        <td>{{ number_format($item->persen_tumbang, 2,'.',',') }}%</td>
<td>{{ number_format($item->total_plan_tanamlcc, 0, ',', '.') }}</td>
<td>{{ number_format($item->total_aktual_tanamlcc, 0, ',', '.') }}</td>
        <td>{{ number_format($item->persen_tanamlcc, 2,'.',',') }}%</td>
    <td>{{ number_format($item->total_plan_tanamks, 0, ',', '.') }}</td>
<td>{{ number_format($item->total_aktual_tanamks, 0, ',', '.') }}</td>
        <td>{{ number_format($item->persen_tanamks, 2,'.',',') }}%</td>
    </tr>
@endforeach
<tr class="table-active">
 <td></td>
    <td>{{ number_format($totalPlanTumbang, 0, ',', '.') }}</td>
    <td>{{ number_format($totalAktualTumbang, 0, ',', '.') }}</td>
    <td>  {{ number_format($persenTT, 2, ',', '.') }}</td>
    <td>{{ number_format($totalPlanTanamlcc, 0, ',', '.') }}</td>
    <td>{{ number_format($totalAktualTanamlcc, 0, ',', '.') }}</td>
<td>{{ number_format($persenTLCC, 2, ',', '.') }}</td>
    <td>{{ number_format($totalPlanTanamks, 0, ',', '.') }}</td>
    <td>{{ number_format($totalAktualTanamks, 0, ',', '.') }}</td>
<td>{{ number_format($persenTKS, 2, ',', '.') }}</td>
    </tr>


					</tbody>
		
</table>

				
            </div>
        </div>
    </div>
</div>
@include('documents.indexsja', ['supportingdoc' => $supportingdoc])

@endsection



@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
