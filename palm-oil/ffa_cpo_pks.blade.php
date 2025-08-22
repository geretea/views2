@extends('layouts.vertical', ['title' => 'FFA CPO'])

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
        <h4 class="fs-18 fw-semibold m-0">FFA CPO</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
                     <li class="breadcrumb-item active">Kinerja Operasional</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
<h5 class="mt-0">Rata-rata FFA CPO Bulanan - {{ $tahun }}</h5>
            </div>
<div class="card-body">
<form method="GET" class="row align-items-center mb-3" action="">
    <div class="col-auto">
        <label for="tahun" class="col-form-label fw-bold">Pilih Tahun</label>
    </div>
    <div class="col-md-2">
        <select id="tahun" name="tahun" class="form-control" onchange="this.form.submit()">
            @foreach($tahunList as $t)
                <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
            @endforeach
        </select>
    </div>
</form>
		  <!-- Chart dan Tabel-->

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>PKS</th>
                @foreach($bulanList as $b)
                    <th>{{ \Carbon\Carbon::createFromFormat('m', $b)->translatedFormat('M') }}</th>
                @endforeach
                <th>Rata-rata Tahunan</th>
            </tr>
        </thead>
		<tbody>
    @foreach($pivot as $pks => $data)
        <tr>
            <td>{{ $pks }}</td>
            @foreach($bulanList as $b)
                <td>{{ $data[$b] ?? '-' }}</td>
            @endforeach
            <td>{{ $data['rata_tahunan'] ?? '-' }}</td>
        </tr>
    @endforeach

    {{-- Baris rata-rata semua PKS --}}
    <tr class="table-secondary fw-bold">
        <td>Rata-rata Semua PKS</td>
        @foreach($bulanList as $b)
            <td>{{ $avgAll[$b] ?? '-' }}</td>
        @endforeach
        <td>{{ $avgAll['rata_tahunan'] ?? '-' }}</td>
    </tr>
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