@extends('layouts.vertical', ['title' => 'Jumlah Karyawan'])

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
        <h4 class="fs-18 fw-semibold m-0">Jumlah Karyawan</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Human Capital</a></li>
            <li class="breadcrumb-item active">Corporate</li>
        </ol>
    </div>
</div
	<!-- Tabel -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Jumlah Karyawan (Lokal/Asing) (2024) </h5>
            </div>

            <div class="card-body">
							<div class="table-responsive" style="overflow-x:auto;">

				<table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th rowspan="2">Provinsi</th>
                <th rowspan="2">Kabupaten</th>
                <th rowspan="2">PT</th>

                <th colspan="3">Lokal</th>
                <th colspan="3">Asing</th>
                <th colspan="3">Grand Total Lokal + Asing</th>
            </tr>
            <tr>
                <th>Laki-Laki</th>
                <th>Perempuan</th>
                <th>Total</th>
                <th>Laki-Laki</th>
                <th>Perempuan</th>
                <th>Total</th>
                <th>Laki-Laki</th>
                <th>Perempuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $provinsi => $kabGroup)
                @foreach($kabGroup as $kabupaten => $lists)
                    @foreach($lists['detail'] as $r)
                    <tr>
                        <td class="text-start">{{ $r['provinsi'] }}</td>
                        <td class="text-start">{{ $r['kabupaten'] }}</td>
                        <td class="text-start">{{ $r['pt'] }}</td>

                        {{-- Local --}}
                        <td>{{ number_format($r['laki_lokal']) }} <br><small>{{ $r['laki_lokal_pct'] }}%</small></td>
                        <td>{{ number_format($r['perempuan_lokal']) }} <br><small>{{ $r['perempuan_lokal_pct'] }}%</small></td>
                        <td>{{ number_format($r['total_lokal']) }} <br><small>{{ $r['total_lokal_pct'] }}%</small></td>

                        {{-- Asing --}}
                        <td>{{ number_format($r['laki_asing']) }} <br><small>{{ $r['laki_asing_pct'] }}%</small></td>
                        <td>{{ number_format($r['perempuan_asing']) }} <br><small>{{ $r['perempuan_asing_pct'] }}%</small></td>
                        <td>{{ number_format($r['total_asing']) }} <br><small>{{ $r['total_asing_pct'] }}%</small></td>

                        {{-- Grand Total --}}
                        <td>{{ number_format($r['grand_laki']) }} <br><small>{{ $r['grand_laki_pct'] }}%</small></td>
                        <td>{{ number_format($r['grand_perempuan']) }} <br><small>{{ $r['grand_perempuan_pct'] }}%</small></td>
                        <td>{{ number_format($r['grand_total']) }} <br><small>{{ $r['grand_total_pct'] }}%</small></td>
                    </tr>
                    @endforeach

                    {{-- Subtotal Kabupaten --}}
                    @php $s = $lists['subtotal']; @endphp
                    <tr class="table-secondary fw-bold">
                        <td class="text-start">{{ $s['provinsi'] }}</td>
                        <td class="text-start">{{ $s['kabupaten'] }}</td>
                        <td class="text-start">{{ $s['pt'] }}</td>

                        <td>{{ number_format($s['laki_lokal']) }} <br><small>{{ $s['laki_lokal_pct'] }}%</small></td>
                        <td>{{ number_format($s['perempuan_lokal']) }} <br><small>{{ $s['perempuan_lokal_pct'] }}%</small></td>
                        <td>{{ number_format($s['total_lokal']) }} <br><small>{{ $s['total_lokal_pct'] }}%</small></td>

                        <td>{{ number_format($s['laki_asing']) }} <br><small>{{ $s['laki_asing_pct'] }}%</small></td>
                        <td>{{ number_format($s['perempuan_asing']) }} <br><small>{{ $s['perempuan_asing_pct'] }}%</small></td>
                        <td>{{ number_format($s['total_asing']) }} <br><small>{{ $s['total_asing_pct'] }}%</small></td>

                        <td>{{ number_format($s['grand_laki']) }} <br><small>{{ $s['grand_laki_pct'] }}%</small></td>
                        <td>{{ number_format($s['grand_perempuan']) }} <br><small>{{ $s['grand_perempuan_pct'] }}%</small></td>
                        <td>{{ number_format($s['grand_total']) }} <br><small>{{ $s['grand_total_pct'] }}%</small></td>
                    </tr>
			
			
			
                @endforeach
            @endforeach
        </tbody>

        <tfoot class="table-dark fw-bold">
            <tr>
                <td colspan="3" class="text-end">Grand Total</td>
                <td>{{ number_format($grandLakiLokal) }}</td>
                <td>{{ number_format($grandPerempuanLokal) }}</td>
                <td>{{ number_format($grandLakiLokal + $grandPerempuanLokal) }}</td>
                <td>{{ number_format($grandLakiAsing) }}</td>
                <td>{{ number_format($grandPerempuanAsing) }}</td>
                <td>{{ number_format($grandLakiAsing + $grandPerempuanAsing) }}</td>
                <td>{{ number_format($grandLakiLokal + $grandLakiAsing) }}</td>
                <td>{{ number_format($grandPerempuanLokal + $grandPerempuanAsing) }}</td>
                <td>{{ number_format($grandTotal) }}</td>
            </tr>
        </tfoot>
    </table>
				</div>
            </div>
        </div>
        </div>
</div>
@include('hcdocs.index', ['HC_supportingdoc' => $HC_supportingdoc])

@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
