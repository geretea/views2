@extends('layouts.vertical', ['title' => 'Data Pemasok TBS'])
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
        <h4 class="fs-18 fw-semibold m-0">Data Pemasok TBS</h4>
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
                <h5 class="card-title mb-0">Data Pemasok TBS</h5>  
            </div>

            <div class="card-body">
   <!-- Filter -->
<form method="GET" action="" class="mb-3">
    <div class="row g-2">
        <div class="col-md-3">
            <select name="pks" class="form-select" onchange="this.form.submit()">
                @foreach($pksList as $item)
                    <option value="{{ $item }}" {{ $pks == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="kategori" class="form-select" onchange="this.form.submit()">
                @foreach($kategoriList as $item)
                    <option value="{{ $item }}" {{ $kategori == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>


    @if($data->isEmpty())
        <div class="alert alert-info">Silakan pilih PKS untuk melihat data pemasok.</div>
    @else
        @foreach($data as $kategori => $rows)
            <h5 class="mt-4">{{ $kategori }}</h5>
<div style="overflow-x:auto;">

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemasok</th>
                        <th>Lokasi</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Provinsi</th>
                        <th class="text-end">Jumlah Petani</th>
                        <th class="text-end">Jumlah Persil</th>
                        <th class="text-end">Luas (Ha)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $i => $row)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $row->nama_pemasok }}</td>
                            <td>{{ $row->lokasi }}</td>
							<td>{{ $row->latitude }}</td>
							<td>{{ $row->longitude }}</td>
                            <td>{{ $row->desa }}</td>
                            <td>{{ $row->kecamatan }}</td>
                            <td>{{ $row->kabupaten }}</td>
                            <td>{{ $row->provinsi }}</td>
                            <td class="text-end">{{ number_format($row->jumlah_petani) }}</td>
                            <td class="text-end">{{ number_format($row->jumlah_persil) }}</td>
                            <td class="text-end">{{ number_format($row->luas) }}</td>
                        </tr>
                    @endforeach
					 @if($rows->count() > 0)
        <tr class="fw-bold table-secondary">
            <td colspan="9" class="text-end">TOTAL</td>
            <td class="text-end">
                {{ number_format($rows->sum('jumlah_petani')) }}
            </td>
            <td class="text-end">
                {{ number_format($rows->sum('jumlah_persil')) }}
            </td>
            <td class="text-end">
                {{ number_format($rows->sum('luas')) }}
            </td>
        </tr>
    @endif
                </tbody>
            </table>
        @endforeach
    @endif
				</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@vite(['resources/js/pages/datatable.init.js'])
@endsection


