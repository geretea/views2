@extends('layouts.vertical', ['title' => 'Posisi Finansial'])

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
        <h4 class="fs-18 fw-semibold m-0">Data Corporate</h4>
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
                <h5 class="card-title mb-0">Posisi Finansial</h5>
            </div>

            <div class="card-body">
@php
$data_PosisiFinansial = App\Models\FinancialPosition::all();
@endphp	

                <table id="datatable" class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr>
                            <th>Deskripsi</th>
                            <th>2023</th>
                            <th>2022</th>
                            <th>2021</th>
                           <th>2020</th>
							<th>2019</th>

                        </tr>
                    </thead>
					<tbody>
						
        @foreach ($data_PosisiFinansial as $index => $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->Y2023 }}</td>
				<td>{{ $item->Y2022 }}</td>
				<td>{{ $item->Y2021 }}</td>
                <td>{{ $item->Y2020 }}</td>
                <td>{{ $item->Y2019 }}</td>

            </tr>

        @endforeach
					
							
    </tbody>
</table>
			
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
