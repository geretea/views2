@extends('layouts.vertical', ['title' => 'Produksi CPO'])

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
        <h4 class="fs-18 fw-semibold m-0">Data Palm Oil</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
    <canvas id="produksiCPOChart" height="300"></canvas>
        </div>
    </div>
</div>
<!-- Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">Produksi CPO </h5>  
 <a href="{{ url('palm-oil/' . $id . '/produksi_cpo_pks') }}" class="btn btn-outline-primary">
        Cek Produksi CPO Bulanan
    </a>
            </div>

            <div class="card-body">

                                  <table class="table table-bordered dt-responsive table-responsive">
                  <thead class="table-dark">
            <tr>
            <th>PKS</th>
            <th>Area</th>
				 @foreach ($tahunList as $year)

                <th>{{ $year }}</th>
            @endforeach
        </tr>

            <tbody>
        @foreach ($groupedData as $pks => $areas)
            @foreach ($areas as $area => $data)
                <tr>

                        <td>{{ $pks }}</td>
                    <td>  <a href="{{ url('palm-oil/' . $id . '/produksi_cpo_area/' . $area) }}">
						{{ $area }}</a></td>
            @foreach ($tahunList as $year)
                        <td>
                            {{ number_format(optional($data->firstWhere('tahun', $year))->total_aktual, 0) ?? '-' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        @endforeach
           <tr class="fw-bold bg-light">
            <td class="text-start" colspan="2">Total All PKS</td>
            @foreach ($tahunList as $year)
                @php
			         $total = $produksiTahunan->firstWhere('tahun', $year)->total_aktual ?? 0;
                @endphp
                <td>{{ number_format($total, 0, ',', '.') }}</td>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('produksiCPOChart').getContext('2d');
	new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [
            {
                type: 'bar',
                label: 'Produksi Aktual (ton)',
                data: {!! json_encode($chartBarValues) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderRadius: 4
            },
            {
                type: 'line',
                label: 'Trend Produksi',
                data: {!! json_encode($chartLineValues) !!},
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                tension: 0.4,
                fill: false,
                pointRadius: 4
            }
        ]
    },
		   options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Produksi CPO per Tahun (All PKS)',
                font: {
                    size: 16
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return new Intl.NumberFormat('id-ID').format(context.parsed.y) + ' ton';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Ton'
                }
            }
			  }
    }
});
</script>

@endsection
