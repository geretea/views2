@extends('layouts.vertical', ['title' => 'OER PKO'])

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
          <canvas id="kerLineChart" height="300"></canvas>
       </div>
    </div>
</div>

<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">Produksi PKO </h5>  
 <a href="{{ url('palm-oil/' . $id . '/ker_bulanan') }}" class="btn btn-outline-primary">
        Cek Data KER Bulanan
    </a>
            </div>

            <div class="card-body">

				<table class="table table-bordered table-sm text-end">
    <thead class="table-light">
        <tr>
            <th class="text-start">PKS</th>
            <th class="text-start">Area</th>
            @foreach ($tahunList as $th)
                <th>{{ $th }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach ($dataTahunan as $pks => $rows)
    @php $area = $rows->first()->area; @endphp
    <tr>
        <td class="text-start">{{ $pks }}</td>
        <td class="text-start">{{ $area }}</td>
        @foreach ($tahunList as $th)
            @php
                $row = $rows->firstWhere('tahun', $th);
                $ker = ($row && $row->total_pk > 0)
                    ? round(($row->total_aktual / $row->total_pk) * 100, 2)
                    : '-';
            @endphp
            <td class="text-end">{{ is_numeric($ker) ? number_format($ker, 2, ',', '.') . ' %' : '-' }}</td>
        @endforeach
    </tr>
@endforeach
<tr class="fw-bold bg-light">
    <td class="text-start" colspan="2">All PKS</td>
    @foreach ($tahunList as $th)
        <td class="text-end">
            {{ is_numeric($kerTotalPerTahun[$th] ?? null) 
                ? number_format($kerTotalPerTahun[$th], 2, ',', '.') . ' %' 
                : '-' }}
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
const ctx = document.getElementById('kerLineChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'KER (%)',
            data: {!! json_encode($chartValues) !!},
            borderColor: '#10b981',
            backgroundColor: 'rgba(16, 185, 129, 0.2)',
            tension: 0.4,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Trend KER per Tahun',
                font: {
                    size: 16
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.parsed.y + ' %';
                    }
                }
            }
        },
     scales: {
    y: {
        beginAtZero: false, // penting!
        suggestedMin: 20,
        suggestedMax: 25,
        title: {
            display: true,
            text: 'KER (%)'
        }
    }
}
    }
});
</script>

@endsection
