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
<!-- Filter PKS -->
    <form method="GET" action="{{ route('data-pemasok.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="pks" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih PKS --</option>
                    @foreach($pksList as $item)
                        <option value="{{ $item }}" {{ $pks == $item ? 'selected' : '' }}>{{ $item }}</option>
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
            <table class="table table-bordered table-striped">
                <thead class="table-light">
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
                            <td class="text-end">{{ number_format($row->luas, 3, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endif

            </div>
        </div>
    </div>
</div>
@include('documents.indexsja', ['supportingdoc' => $supportingdoc])

@endsection

@section('script')
@vite(['resources/js/pages/datatable.init.js'])
@endsection


