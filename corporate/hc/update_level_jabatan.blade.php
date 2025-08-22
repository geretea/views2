@extends('layouts.vertical', ['title' => 'Level Jabatan'])

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
        <h4 class="fs-18 fw-semibold m-0">Karyawan</h4>
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
		
                <h5 class="card-title mb-0">Karyawan Berdasarkan Level Jataban, Usia & Jenis Kelamin</h5>
            </div>

            <div class="card-body">
<form id="editableForm" method="POST" action="{{ route('corporate.hc.update_level_jabatan') }}">
    @csrf
    <table class="table table-bordered dt-responsive table-responsive">
        <thead>
            <tr>
                <th rowspan="2">Level Jabatan</th>
                @foreach($positions as $pos)
                    <th colspan="2">{{ $pos }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach($positions as $pos)
                    <th>Laki-Laki</th>
                    <th>Perempuan</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($ageGroups as $age)
                <tr>
                    <td>{{ $age }}</td>
                    @foreach($positions as $pos)
                        <td>
                            <input 
                                type="number" 
                                name="data[{{ $age }}][{{ $pos }}][Laki-laki]" 
                                value="{{ $data[$age][$pos]['Laki-laki'] }}" 
                                class="form-control"
                            >
                        </td>
                        <td>
                            <input 
                                type="number" 
                                name="data[{{ $age }}][{{ $pos }}][Perempuan]" 
                                value="{{ $data[$age][$pos]['Perempuan'] }}" 
                                class="form-control"
                            >
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>

			
            </div>
        </div>
	</div>
</div>
@include('hcdocs.index', ['HC_supportingdoc' => $HC_supportingdoc])

@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection

