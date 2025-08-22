@extends('layouts.vertical', ['title' => 'Inovasi Penurunan Energi'])
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
        <h4 class="fs-18 fw-semibold m-0">Energi</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Sustainability</a></li>
            <li class="breadcrumb-item active">Energi</li>
        </ol>
    </div>
    </div>
<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header">
                <h5 class="card-title mb-0">Inovasi Penurunan Energi</h5>  
            </div>

            <div class="card-body">
<form method="GET" class="row align-items-center mb-3" action="">
    <div class="col-auto">
        <label for="tahun" class="col-form-label fw-bold">Pilih Tahun</label>
    </div>
    <div class="col-md-2">
        <select id="tahun" name="tahun" class="form-control" onchange="this.form.submit()">
            @foreach($tahunList as $tahun)
                <option value="{{ $tahun }}" {{ $tahun == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
            @endforeach
        </select>
    </div>
</form>
       <table class="table table-bordered">
    <thead class="table-dark">
        <tr>
			<th>SBU</th>
            <th>Bentuk Investasi</th>
            <th>Tujuan Investasi</th>
            <th>Biaya</th>
            <th>Capaian</th>
        </tr>
    </thead>
    <tbody>
        @foreach($filtered as $row)
            <tr>
                <td>{{ $row->sbu }}</td>
                <td>{{ $row->bentuk }}</td>
				<td>{{ $row->tujuan }}</td>
                <td>{{ $row->biaya }}</td>
                <td>{{ $row->capaian }}</td>
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


