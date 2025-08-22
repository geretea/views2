@extends('layouts.vertical', ['title' => 'Kebun Inti & Plasma'])
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
        <h4 class="fs-18 fw-semibold m-0">Data Kebun Inti dan Kemitraan</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Information Update</li>
        </ol>
    </div>
    </div>
<!-- Tabel -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">Kebun Inti & Kemitraan </h5>  

            </div>

            <div class="card-body">

 <table id="datatable" class="table table-bordered dt-responsive table-responsive">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Perusahaan</th>
                           <th>Provinsi</th>
							<th>Kabupaten</th>
                            <th>Status</th>
							<th>Keterangan</th>
                            <th>Luas (Ha)</th>
                            <th>Sertifikasi</th>
                           <th>Produk</th>
		                        </tr>
                    </thead>
					<tbody>
						
        @foreach ($data as $index => $item)
            <tr   @if($item->status=='Kemitraan') class="table-primary"   @endif>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->nama_perusahaan }} ({{ $item->singkatan }})</td>
				<td>{{ $item->provinsi }}</td>
				<td>{{ $item->kabupaten }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->keterangan }}</td>
				<td class="text-end">{{ number_format($item->luas, 0, ',','.') }}</td>
				<td>{{ $item->sertifikasi }}</td>
                <td>{{ $item->produk }}</td>
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
@vite(['resources/js/pages/datatable.init.js'])
@endsection


