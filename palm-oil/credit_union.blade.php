@extends('layouts.vertical', ['title' => 'Credit Union'])

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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Credit Union</h5>
            </div>

            <div class="card-body">

                <table  class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr class="table-primary">
                            <th>ID</th>
                            <th >Nama CU</th>
                        @foreach(array_reverse($years) as $year) 
                <th colspan="2"> {{ $year }}</th>
            @endforeach
                       
                        </tr>
						
						 <tr class="table-active">
            <th></th>
            <th></th>
            @foreach(array_reverse($years) as $year)
                <th>Jumlah Anggota</th>
                <th>Total Aset (Rp miliar)</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php
            $groupedData = $data_CU->groupBy('nama_cu'); // Group data by nama_cu
        @endphp

        @foreach ($groupedData as $index => $group)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $index }}</td>
            @foreach(array_reverse($years) as $year)
                @php
                    $record = $group->firstWhere('tahun', $year); // Find data for the year
                @endphp
                <td>{{ number_format($record->total_anggota, 0, ',', '.') }}</td>
                <td>{{ number_format($record->total_aset, 2, ',', ',') }}</td>
            @endforeach
        </tr>
        @endforeach
					</tbody>
					<tbody>
		    <tr class="fw-bold table-active">
            <td colspan='2'>Total</td>
            @foreach(array_reverse($years) as $year)
                @php
                    $total = $totalPerTahun[$year] ?? null;
                @endphp
                
				<td>
                    @if($total)
                        {{ number_format($total->total_anggota, 0, ',', '.') }} 
					<td>
						{{ number_format($total->total_aset, 2, ',', ',') }} </td>
                    @else
                        -
                    @endif
            @endforeach
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
