@extends('layouts.vertical', ['title' => 'ASP PK'])

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
        <h4 class="fs-18 fw-semibold m-0">Palm Oil</h4>
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
          <canvas id="aspLineChart" height="300"></canvas>
       </div>
    </div>
</div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">ASP PK (Rp/kg)</h5>  
 <a href="{{ url('palm-oil/' . $id . '/pk_asp_bulanan') }}" class="btn btn-outline-primary">
        Cek Data ASP Bulanan
    </a>
            </div>

            <div class="card-body">

				<table class="table table-bordered table-sm text-end">
    <thead class="table-light">
        <tr>
            <th class="text-start">PT</th>
            <th class="text-start">Area</th>
            @foreach ($tahunList as $th)
                <th>{{ $th }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach ($dataTahunan as $perusahaan => $rows)
    @php $area = $rows->first()->area; @endphp
    <tr>
        <td class="text-start">{{ $perusahaan }}</td>
        <td class="text-start">{{ $area }}</td>
        @foreach ($tahunList as $th)
            @php
                $row = $rows->firstWhere('tahun', $th);
                $asp = ($row && $row->total_volume > 0)
                    ? ($row->total_revenue / $row->total_volume)  : 0;
            @endphp
            <td class="text-end">{{ is_numeric($asp) ? number_format($asp, 3, '.', ',') : '-' }}
</td>
        @endforeach
    </tr>
@endforeach
<tr class="fw-bold bg-light">
    <td class="text-start" colspan="2">All PT</td>
    @foreach ($tahunList as $th)
        <td class="text-end">
            {{ is_numeric($aspTotalPerTahun[$th] ?? null) 
                ? number_format($aspTotalPerTahun[$th], 3, '.', ',') : '-' }}
        </td>
    @endforeach
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
    @vite([ 'resources/js/pages/datatable.init.js'])

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('aspLineChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'ASP (Rp/kg)',
            data: {!! json_encode($chartValues) !!},
            borderColor: '#10b981',
            backgroundColor: 'rgba(174, 192, 12, 0.2)',
            tension: 0.4,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const value = context.raw;
                        return new Intl.NumberFormat('id-ID', {
                            minimumFractionDigits: 3,
                            maximumFractionDigits: 3
                        }).format(value);
                    }
                }
            }
        },
        scales: {
            y: {
                ticks: {
                    callback: function(value) {
                        return new Intl.NumberFormat('id-ID', {
                            minimumFractionDigits: 3,
                            maximumFractionDigits: 3
                        }).format(value);
                    }
                }
            }
        }
    }
});
</script>

@endsection
