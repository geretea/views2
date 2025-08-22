@extends('layouts.vertical', ['title' => 'Credit Union'])

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
        <h4 class="fs-18 fw-semibold m-0">Sustainability</h4>
    </div>
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="#">CSR</a></li>
            <li class="breadcrumb-item active">Credit Union</li>
        </ol>
    </div>
</div>

@php $chartData = []; @endphp

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Grafik Credit Union ({{ $years[0] }} sampai {{ end($years) }})</h5>
    </div>
            <div class="card-body">
@php
    $chartIndex = 0;
@endphp

@foreach ($data_CU as $cuName => $records)
    <div class="row">
        <h5>{{ $cuName }}</h5>
        <div class="col-md-6">
            <div id="anggota-chart-{{ Str::slug($cuName) }}"></div>
        </div>
        <div class="col-md-6">
            <div id="aset-chart-{{ Str::slug($cuName) }}"></div>
        </div>
    </div>

    @php
				  $chartData[Str::slug($cuName)] = [
            'cuName' => $cuName,
            'records' => $records,
            'colorIndex' => $chartIndex++,
        ];
    @endphp
@endforeach


            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Jumlah Anggota --}}
    <div class="col-md-6 col-xl-6">
        <div class="card overflow-hidden">
            <div class="card-header">
                <h5 class="card-title mb-0">Jumlah Anggota per Credit Union (2024)</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-traffic mb-0">
                        <thead>
                            <tr>
								      <th>Nama CU</th>
                                <th>Anggota</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggotaCU as $cu)
                                @php
                                    $percentage = ($cu->total_anggota / $maxAnggota) * 100;
                                @endphp
                                <tr>
                                    <td>{{ $cu->nama_cu }}</td>
                                    <td>{{ number_format($cu->total_anggota, 0, ',', '.') }}</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-info" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	 {{-- Total Aset --}}
    <div class="col-md-6 col-xl-6">
        <div class="card overflow-hidden">
            <div class="card-header">
                <h5 class="card-title mb-0">Total Aset per Credit Union (2024)</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-traffic mb-0">
                        <thead>
                            <tr>
                                <th>Nama CU</th>
                                <th>Aset (Rp miliar)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asetCU as $cu)
                                @php
                                    $percentage = ($cu->total_aset / $maxAset) * 100;
                                @endphp
                                <tr>
                                    <td>{{ $cu->nama_cu }}</td>
                                    <td>Rp {{ number_format($cu->total_aset, 2, ',', '.') }}</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
											          <div class="progress-bar bg-success" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Credit Union</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered dt-responsive table-responsive">
                    <thead>
                        <tr class="table-primary">
                            <th>ID</th>
							     <th>Nama CU</th>
                            @foreach(array_reverse($years) as $year)
                                <th colspan="2">{{ $year }}</th>
                            @endforeach
                        </tr>
                        <tr class="table-active">
                            <th></th>
                            <th></th>
                            @foreach(array_reverse($years) as $year)
                                <th>Jumlah Anggota</th>
                                <th>Total Aset (Rp miliar)</th>
                            @endforeach
                        </tr>
                    </thead>
               <tbody>
    @foreach ($data_CU as $index => $group)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $index }}</td>
            @foreach(array_reverse($years) as $year)
                @php
                    $record = $group->firstWhere('tahun', $year);
                @endphp
                <td>{{ $record ? number_format($record->total_anggota, 0, ',', '.') : '-' }}</td>
                <td>{{ $record ? number_format($record->total_aset, 2, ',', '.') : '-' }}</td>
            @endforeach
			     </tr>
    @endforeach
</tbody>
                    <tbody>
                        <tr class="fw-bold table-active">
                            <td colspan="2">Total</td>
                            @foreach(array_reverse($years) as $year)
                                @php $total = $totalPerTahun[$year] ?? null; @endphp
                                <td>{{ $total ? number_format($total->total_anggota, 0, ',', '.') : '-' }}</td>
                                <td>{{ $total ? number_format($total->total_aset, 2, ',', '.') : '-' }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    const chartDataCU = @json($chartData);
    const tahunListCU = @json($years);
</script>

<script src="{{ asset('js/cu_barchart.js') }}"></script>

@include('documents.indexsja', ['supportingdoc' => $supportingdoc])

@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection