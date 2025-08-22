@extends('layouts.vertical', ['title' => 'Data PKS'])

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

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data PKS</h5>
            </div>

            <div class="card-body">
@php
$data_pks = App\Models\DataPKS::all();
@endphp	

                <table class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama PKS</th>
                            <th>Perusahaan</th>
                            <th>Alamat</th>
                            <th>Kapasitas CPO (ton/jam)</th>
                            <th>Lokasi</th>
                            <th>Latitude</th>
                           <th>Longitude</th>
                        </tr>
                    </thead>
					<tbody>
 @php $total_kapasitas = 0; @endphp 
        @foreach ($data_pks as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_pks }}</td>
                <td>{{ $item->nama_pt }}</td>
                <td>{{ $item->alamat }}</td>
				<td>{{ $item->kapasitas_cpo }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->latitude }}</td>
                <td>{{ $item->longitude }}</td>
            </tr>
			@php $total_kapasitas += $item->kapasitas_cpo; @endphp 

        @endforeach
						<tr>
							<td colspan='4' ><strong>Total Kapasitas</strong></td>
							<td><strong>{{ $total_kapasitas }}</strong></td>
							<td colspan='3'></td>
						</tr>
							
    </tbody>
</table>
			
            </div>
        </div>
    </div>
</div>


@endsection


