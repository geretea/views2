@extends('layouts.vertical', ['title' => 'Penggunaan Pupuk Kimia'])
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
        <h4 class="fs-18 fw-semibold m-0">Pupuk Kimia</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
            <li class="breadcrumb-item active">Kinerja Operasional</li>
        </ol>
    </div>
    </div>
<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header">
                <h5 class="card-title mb-0">Monitoring Penggunaan Pupuk Kimia (Tahun {{ $tahunAktif }})</h5>  
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
            <th>Jenis Pupuk</th>
            <th>Total (Ton)</th>
            <th>Luasan Aplikasi (Ha)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($filtered as $row)
            <tr>
                <td class="text-start">{{ $row->jenis_pupuk }}</td>
                <td class="text-end">{{ number_format($row->total,0,',','.') }}</td>
                <td class="text-end">{{ number_format($row->luasan_aplikasi, 0,',','.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data</td>
            </tr>
	
        @endforelse
    <tr class="fw-bold table-secondary">
        <td class="text-start">TOTAL TAHUN {{ $tahunAktif }}</td>
        <td class="text-end">{{ number_format($totalJumlah, 0, ',', '.') }}</td>
        <td class="text-end">{{ number_format($totalLuas, 0, ',', '.') }}</td>
    </tr>
    </tbody>
		</table>
    </div>


            </div>
        </div>
    </div>
</div>
@include('documents.indexsja', ['supportingdoc' => $supportingdoc])

@endsection

@section('script')
@vite(['resources/js/pages/datatable.init.js'])
@endsection


