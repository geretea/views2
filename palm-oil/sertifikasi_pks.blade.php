@extends('layouts.vertical', ['title' => 'Sertifikasi PKS'])

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
        <h4 class="fs-18 fw-semibold m-0">Sertifikasi PKS</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Sertifikasi</li>
        </ol>
    </div>
</div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sertifikasi  PKS</h5>
            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sertifikat</th>
                            <th>Penerbit</th>
                            <th>No. Sertifikat</th>
                           <th>Periode</th>
							<th>Unit Pengelola</th>
                            <th>Pabrik</th>
                            <th>Kebun Pemasok</th>
                            <th>File</th>
                        </tr>
                    </thead>
					<tbody>
						
        @foreach ($data_sertifikasi_pks as $index => $item)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->tipe_sertifikat }}</td>
				<td>{{ $item->penerbit }}</td>
				<td>{{ $item->no_sertifikat }}</td>
				<td>{{ date('d M Y', strtotime($item->tgl_berlaku))}} - {{ date('d M Y', strtotime($item->tgl_berakhir))}}</td>

                <td>{{ $item->unit_pengelola }}</td>
                <td>{{ $item->pabrik }}</td>
				<td>{{ $item->kebun_pemasok }}</td>
                        <td>view </td>
            </tr>

        @endforeach
					
							
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
