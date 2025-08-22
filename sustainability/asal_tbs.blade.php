@extends('layouts.vertical', ['title' => 'Asal TBS'])
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
        <h4 class="fs-18 fw-semibold m-0">Asal TBS</h4>
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
                <h5 class="card-title mb-0">Asal TBS</h5>  
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
            <th>PT</th>
            <th>PKS</th>
            <th>Kebun Inti</th>
            <th>Kebun Plasma</th>
            <th>IPC</th>
            <th>Koperasi</th>
            <th>Agen</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($filtered as $row)
            <tr>
                <td>{{ $row->pt }}</td>
                <td class="text-end">{{ $row->pks }}</td>
                <td class="text-end">{{ number_format($row->kebun_inti,2,',','.') }}</td>
                <td class="text-end">{{ number_format($row->kebun_plasma, 2,',','.') }}</td>
                <td class="text-end">{{ number_format($row->ipc, 2,',','.') }}</td>
				<td class="text-end">{{ number_format($row->koperasi, 2,',','.') }}</td>
                <td class="text-end">{{ number_format($row->agen, 2,',','.') }}</td>
				<td class="text-end">{{ number_format($row->total,2,',','.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data</td>
            </tr>
        @endforelse
		 {{-- baris total --}}
    <tr class="fw-bold table-secondary">
        <td>Total</td>
		<td></td>
        <td class="text-end">{{ number_format($grandTotal['kebun_inti'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['kebun_plasma'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['ipc'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['koperasi'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['agen'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['total'],2,',','.') }}</td>
    </tr>
    </tbody>
</table>
    </div>


            </div>
        </div>
    </div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header">
                <h5 class="card-title mb-0">Ketelusuran</h5>  
            </div>

            <div class="card-body">
       <table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>PT</th>
            <th>PKS</th>
            <th>Traceable</th>
            <th>%</th>
            <th>Untraceable</th>
            <th>%</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($filtered as $row)
            <tr>
                <td>{{ $row->pt }}</td>
                <td class="text-end">{{ $row->pks }}</td>
                <td class="text-end">{{ number_format($row->traceable,2,',','.') }}</td>
                <td class="text-end">{{ number_format($row->persen_traceable, 2,',','.') }}</td>
                <td class="text-end">{{ number_format($row->untraceable, 2,',','.') }}</td>
				<td class="text-end">{{ number_format($row->persen_untraceable, 2,',','.') }}</td>
				<td class="text-end">{{ number_format($row->total,2,',','.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data</td>
            </tr>
        @endforelse
		 {{-- baris total --}}
    <tr class="fw-bold table-secondary">
        <td>Total</td>
		<td></td>
        <td class="text-end">{{ number_format($grandTotal['traceable'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['persen_traceable'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['untraceable'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['persen_untraceable'],2,',','.') }}</td>
        <td class="text-end">{{ number_format($grandTotal['total'],2,',','.') }}</td>
    </tr>
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


