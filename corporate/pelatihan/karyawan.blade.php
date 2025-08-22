@extends('layouts.vertical', ['title' => 'Pelatihan Karyawan'])

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
            <li class="breadcrumb-item active">Pelatihan</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Pelatihan Karyawan</h5>
            </div>

            <div class="card-body">

                <table  class="table table-bordered dt-responsive table-responsive">
             <thead>
            <tr>
                <th rowspan="2">SBU</th>
                <th rowspan="2">Jenis Pelatihan</th>
                @foreach($tahunTerakhir as $tahun)
                    <th colspan="3" class="text-center">{{ $tahun }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach($tahunTerakhir as $tahun)
                    <th>Jumlah Pelatihan</th>
                    <th>Jumlah Peserta</th>
                    <th>Jumlah Jam</th>
                @endforeach
            </tr>
        </thead>
      <tbody>
    @foreach($pelatihan as $sbu => $data)
        @php
            $groupedByPelatihan = $data->groupBy('jenis_pelatihan');
        @endphp
        @foreach($groupedByPelatihan as $jenis_pelatihan => $items)
            <tr>
                @if ($loop->first)
                    <td rowspan="{{ count($groupedByPelatihan) }}">{{ $sbu }}</td>
                @endif
                <td>{{ $jenis_pelatihan }}</td>
                @foreach($tahunTerakhir as $tahun)
                    @php
                        $pelatihanData = $items->where('tahun', $tahun)->first();
                    @endphp
<td>{{ number_format($pelatihanData->jumlah_pelatihan ?? 0, 0, ',', '.') }}</td>
<td>{{ number_format($pelatihanData->jumlah_peserta ?? 0, 0, ',', '.') }}</td>
<td>{{ number_format($pelatihanData->jumlah_jam ?? 0, 0, ',', '.') }}</td>
                @endforeach
            </tr>
        @endforeach
		  
		  
       <tr class="fw-bold bg-light">
                    <td colspan="2" class="text-end">Total {{ $sbu }}</td>
                    @foreach($tahunTerakhir as $tahun)
		        
                     <td>{{ number_format($total_per_sbu[$sbu]->total_pelatihan ?? 0, 0, ',', '.') }}</td>
                    <td>{{ number_format($total_per_sbu[$sbu]->total_peserta ?? 0, 0, ',', '.') }}</td>
                    <td>{{ number_format($total_per_sbu[$sbu]->total_jam ?? 0, 0, ',', '.') }}</td>
                    @endforeach
                </tr>
            @endforeach
</tbody>
        <tfoot>
            <tr class="fw-bold bg-dark text-white">
                <td colspan="2" class="text-end">Total Keseluruhan</td>
                @foreach($total_all as $data)
                    <td>{{ number_format($data->total_pelatihan ?? 0, 0, ',', '.') }}</td>
                    <td>{{ number_format($data->total_peserta ?? 0, 0, ',', '.') }}</td>
                    <td>{{ number_format($data->total_jam ?? 0, 0, ',', '.') }}</td>
                @endforeach
            </tr>
        </tfoot>
    </table>
				
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection

