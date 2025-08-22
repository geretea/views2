@extends('layouts.vertical', ['title' => 'Karyawan'])

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
        <h4 class="fs-18 fw-semibold m-0">Data Karyawan</h4>
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

                <h5 class="card-title mb-0">Karyawan Berdasarkan Usia (2024)</h5>
            </div>

            <div class="card-body">
			<div class="table-responsive" style="overflow-x:auto;">
				
				<table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th rowspan="2">Provinsi</th>
                <th rowspan="2">Kabupaten</th>
                <th rowspan="2">PT</th>

                <th colspan="3">18 - 30 Th</th>
                <th colspan="3">31 - 50 Th</th>
				<th colspan="3">Di atas 50 Th</th>
                <th colspan="3">Grand Total</th>
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

                        {{-- 18-30 --}}
                        <td>{{ number_format($r['laki_18_30']) }} <br><small>{{ $r['laki_18_30_pct'] }}%</small></td>
                        <td>{{ number_format($r['perempuan_18_30']) }} <br><small>{{ $r['perempuan_18_30_pct'] }}%</small></td>
                        <td>{{ number_format($r['total_18_30']) }} <br><small>{{ $r['total_18_30_pct'] }}%</small></td>

                        {{-- 31-50 --}}
                        <td>{{ number_format($r['laki_31_50']) }} <br><small>{{ $r['laki_31_50_pct'] }}%</small></td>
                        <td>{{ number_format($r['perempuan_31_50']) }} <br><small>{{ $r['perempuan_31_50_pct'] }}%</small></td>
                        <td>{{ number_format($r['total_31_50']) }} <br><small>{{ $r['total_31_50_pct'] }}%</small></td>
					
						{{-- Atas 50 --}}
                        <td>{{ number_format($r['laki_atas50']) }} <br><small>{{ $r['laki_atas50_pct'] }}%</small></td>
                        <td>{{ number_format($r['perempuan_atas50']) }} <br><small>{{ $r['perempuan_atas50_pct'] }}%</small></td>
                        <td>{{ number_format($r['total_atas50']) }} <br><small>{{ $r['total_atas50_pct'] }}%</small></td>


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

                        <td>{{ number_format($s['laki_18_30']) }} <br><small>{{ $s['laki_18_30_pct'] }}%</small></td>
                        <td>{{ number_format($s['perempuan_18_30']) }} <br><small>{{ $s['perempuan_18_30_pct'] }}%</small></td>
                        <td>{{ number_format($s['total_18_30']) }} <br><small>{{ $s['total_18_30_pct'] }}%</small></td>

                        <td>{{ number_format($s['laki_31_50']) }} <br><small>{{ $s['laki_31_50_pct'] }}%</small></td>
                        <td>{{ number_format($s['perempuan_31_50']) }} <br><small>{{ $s['perempuan_31_50_pct'] }}%</small></td>
                        <td>{{ number_format($s['total_31_50']) }} <br><small>{{ $s['total_31_50_pct'] }}%</small></td>

						 <td>{{ number_format($s['laki_atas50']) }} <br><small>{{ $s['laki_atas50_pct'] }}%</small></td>
                        <td>{{ number_format($s['perempuan_atas50']) }} <br><small>{{ $s['perempuan_atas50_pct'] }}%</small></td>
                        <td>{{ number_format($s['total_atas50']) }} <br><small>{{ $s['total_atas50_pct'] }}%</small></td>
						
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
                <td>{{ number_format($grandLaki18_30) }}</td>
                <td>{{ number_format($grandPerempuan18_30) }}</td>
                <td>{{ number_format($grandLaki18_30 + $grandPerempuan18_30) }}</td>
				
                <td>{{ number_format($grandLaki31_50) }}</td>
                <td>{{ number_format($grandPerempuan31_50) }}</td>
                <td>{{ number_format($grandLaki31_50 + $grandPerempuan31_50) }}</td>
			
				<td>{{ number_format($grandLakiatas50) }}</td>
                <td>{{ number_format($grandPerempuanatas50) }}</td>
                <td>{{ number_format($grandLakiatas50 + $grandPerempuanatas50) }}</td>
				
                <td>{{ number_format($grandLaki18_30 + $grandLaki31_50 + $grandLakiatas50) }}</td>
                <td>{{ number_format($grandPerempuan18_30 + $grandPerempuan31_50 + $grandPerempuanatas50) }}</td>
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
