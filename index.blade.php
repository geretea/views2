@extends('layouts.vertical', ['title' => 'Kebutuhan Data'])

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
        <h4 class="fs-18 fw-semibold m-0">Welcome {{ Auth::user()->name ?? 'Guest' }} </h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>
</div>
<!-- start row -->
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="row g-3">

            <div class="col-md-2 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
							    <div class="col-12">
                                <div class="d-flex align-items-center">
									@php
    $totalData = DB::table('kebutuhan_data')
        ->count();
@endphp
                                    <div class="fs-14 mb-1 text-muted">Total Data</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-0">
                                    <div class="fs-20 mb-0 me-2 fw-semibold text-dark">{{ $totalData }}</div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
			     <div class="col-md-2 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
							    <div class="col-12">
                                <div class="d-flex align-items-center">
	@php
    $dataPalmOil = DB::table('kebutuhan_data')
        ->where('kategori', 'palm-oil')
        ->count();
@endphp
                                    <div class="fs-14 mb-1 text-muted">Palm Oil</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-0">
                                    <div class="fs-20 mb-0 me-2 fw-semibold text-dark">{{ $dataPalmOil }}</div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
			
			     <div class="col-md-2 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
							    <div class="col-12">
                                <div class="d-flex align-items-center">
										@php
    $dataWP = DB::table('kebutuhan_data')
        ->where('kategori', 'wood-product')
        ->count();
@endphp
                                    <div class="fs-14 mb-1 text-muted">Wood Product</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-0">
                                    <div class="fs-20 mb-0 me-2 fw-semibold text-dark">{{ $dataWP }}</div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>     <div class="col-md-2 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
							    <div class="col-12">
                                <div class="d-flex align-items-center">
										@php
    $dataSustainability = DB::table('kebutuhan_data')
        ->where('kategori', 'sustainability')
        ->count();
@endphp
                                    <div class="fs-14 mb-1 text-muted">Sustainability</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-0">
                                    <div class="fs-20 mb-0 me-2 fw-semibold text-dark">{{ $dataSustainability }}</div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>     <div class="col-md-2 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
							    <div class="col-12">
                                <div class="d-flex align-items-center">
										@php
    $dataCorporate = DB::table('kebutuhan_data')
        ->where('kategori', 'corporate')
		->orWhere('kategori', 'renewable-energy')
        ->count();
@endphp
                                    <div class="fs-14 mb-1 text-muted">Corporate/RE</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-0">
                                    <div class="fs-20 mb-0 me-2 fw-semibold text-dark">{{ $dataCorporate }}</div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
     <div class="col-md-2 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
							    <div class="col-12">
                                <div class="d-flex align-items-center">
													@php
    $dataHC = DB::table('kebutuhan_data')
        ->where('kategori', 'human-capital')
        ->count();
@endphp
                                    <div class="fs-14 mb-1 text-muted">Human Capital</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-0">
                                    <div class="fs-20 mb-0 me-2 fw-semibold text-dark">{{ $dataHC }}</div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div> <!-- end row -->

<!-- Datatables -->
<div class="row">
	
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data</h5>
            </div>

            <div class="card-body">
@php
$data = App\Models\Data::all();
@endphp		
				
                <table id="datatable" class="table table-traffic table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr class="table-primary">
                            <th>ID</th>
						 <th>SBU</th>
						 <th>Data</th>

                            <th>User</th>
                            <th>Jenis Data</th>
					 <th>Tujuan Pelaporan</th>

                        </tr>
                    </thead>
					<tbody>

        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
				 <td>{{ $item->sbu }}</td>
				 <td>{{ $item->sub_kategori }}</td>
				   <td>{{ $item->user }}</td>
                <td><a href="{{ url('/' . $item->kategori . '/' . $item->id . '/' . $item->url) }}" target="_blank">
					{{ $item->jenis_data }}</a> </td>
			<td>{{ $item->tujuan_laporan }}</td>

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
