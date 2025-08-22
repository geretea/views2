@extends('layouts.vertical', ['title' => 'Rasio Upah'])

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
        <h4 class="fs-18 fw-semibold m-0">Rasio Upah</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">HC</li>
        </ol>
    </div>
</div>

<!-- Tabel -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
		
                <h5 class="card-title mb-0">Rasio Upah Berdasarkan Jataban </h5>
            </div>

            <div class="card-body">

                <table class="table table-bordered dt-responsive table-responsive">
                  <thead>
      <tr>
                        <th>Jabatan</th>
                        @php
                            $tahunList = collect($groupedData)->flatMap(fn($tahunData) => array_keys($tahunData->toArray()))
                            ->unique()->sortDesc()->values();
                        @endphp
                        @foreach($tahunList as $tahun)
                            <th>{{ $tahun }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($groupedData as $jabatan => $tahunData)
                        <tr>
                            <td>{{ $jabatan }}</td>
                            @foreach($tahunList as $tahun)
                                <td>
                                    @if(isset($tahunData[$tahun]))
                                        {{ $tahunData[$tahun]->first()->rasio }}
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
        </tbody>
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

