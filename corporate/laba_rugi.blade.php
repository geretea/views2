@extends('layouts.vertical', ['title' => 'Laba Rugi'])

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
        <h4 class="fs-18 fw-semibold m-0">Corporate</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Laba Rugi</li>
        </ol>
    </div>
</div>

<!-- Tabel -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
		
                <h5 class="card-title mb-0">Laba Rugi </h5>
            </div>

            <div class="card-body">

                <table class="table table-bordered dt-responsive table-responsive">
                  <thead>
            <tr>
                <th>Deskripsi</th>
                @foreach ($years as $year)
                    <th>{{ $year }}</th>
                @endforeach
            </tr>
				 <tbody>
            @foreach ($processedData as $row)
                <tr>
                    <td>{{ $row['deskripsi'] }}</td>
                    @foreach ($years as $year)
                        <td>{{ number_format($row[$year], 0) }}</td>
                    @endforeach
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

