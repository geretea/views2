@extends('layouts.vertical', ['title' => 'Sales Palm Kernel'])

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
    <div class="col-md-6">
        <div class="card">
    <canvas id="volume_PKChart" height="300"></canvas>
        </div>
    </div>
     <div class="col-md-6">
        <div class="card">
    <canvas id="revenue_PKChart" height="300"></canvas>
        </div>
    </div>
 </div>
<!-- Datatables Sales Volume-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">Sales Volume CPO </h5>  
 <a href="{{ url('palm-oil/' . $id . '/sales_pk_pt') }}" class="btn btn-outline-primary">
        Cek Sales Volume CPO Bulanan
    </a>
            </div>

            <div class="card-body">

				  <table class="table table-bordered dt-responsive table-responsive">
                  <thead class="table-dark">
            <tr>
            <th>PT</th>
            <th>Area</th>
                       @foreach ($tahunList as $year)
                <th>{{ $year }}</th>
            @endforeach
        </tr>

            <tbody>
        @foreach ($groupedData as $perusahaan => $areas)
            @foreach ($areas as $area => $data)
                <tr>
               
                        <td>{{ $perusahaan }}</td>
                    <td>{{ $area }}</td>
            @foreach ($tahunList as $year)
                        <td>
                            {{ number_format(optional($data->firstWhere('tahun', $year))->total_volume, 0) ?? '-' }}
                        </td>
                     
                    @endforeach
                </tr>
            @endforeach
        @endforeach
           <tr class="fw-bold bg-light">
            <td class="text-start" colspan="2">Total All PT</td>
            @foreach ($tahunList as $year)
                @php
                    $totalVolume = $salesTahunan->firstWhere('tahun', $year)->total_volume ?? 0;

                @endphp
                <td>{{ number_format($totalVolume, 0, ',', '.') }}</td>

            @endforeach
        </tr>
    </tbody>
</table>

			
            </div>
        </div>
    </div>
</div>

<!-- Datatables Sales Revenue-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h5 class="card-title mb-0">Sales Revenue PK </h5>  
 <a href="{{ url('palm-oil/' . $id . '/sales_pk_pt') }}" class="btn btn-outline-primary">
        Cek Sales Revenue PK Bulanan
    </a>
            </div>

            <div class="card-body">

				  <table class="table table-bordered dt-responsive table-responsive">
                  <thead class="table-dark">
            <tr>
            <th>PT</th>
            <th>Area</th>
                       @foreach ($tahunList as $year)

                <th>{{ $year }}</th>
            @endforeach
        </tr>

            <tbody>
        @foreach ($groupedData as $perusahaan => $areas)
            @foreach ($areas as $area => $data)
                <tr>
               
                        <td>{{ $perusahaan }}</td>
                    <td>{{ $area }}</td>
            @foreach ($tahunList as $year)
                       <td>
                            {{ number_format(optional($data->firstWhere('tahun', $year))->total_revenue, 0) ?? '-' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        @endforeach
           <tr class="fw-bold bg-light">
            <td class="text-start" colspan="2">Total All PT</td>
            @foreach ($tahunList as $year)
                @php
                    $totalRevenue = $salesTahunan->firstWhere('tahun', $year)->total_revenue ?? 0;

                @endphp
                <td>{{ number_format($totalRevenue, 0, ',', '.') }}</td>

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
const ctx1 = document.getElementById('volume_PKChart').getContext('2d');

new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [
            {
                type: 'bar',
                label: 'Sales Volume (ton)',
                data: {!! json_encode($chartBarValues_Volume) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderRadius: 4
            },
            {
                type: 'line',
                label: 'Trend Sales Volume',
                data: {!! json_encode($chartLineValues_Volume) !!},
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
                text: 'Sales Volume PK per Tahun (All PT)',
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

<script>
const ctx = document.getElementById('revenue_PKChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [
            {
                type: 'bar',
                label: 'Sales Revenue (Rp)',
                data: {!! json_encode($chartBarValues_Revenue) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderRadius: 4
            },
            {
                type: 'line',
                label: 'Trend Sales Revenue',
                data: {!! json_encode($chartLineValues_Revenue) !!},
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
                text: 'Sales Revenue PK per Tahun (All PT)',
                font: {
                    size: 16
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                     return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
					      title: {
                    display: true,
                    text: 'Rp'
                }
            }
        }
    }
});
</script>

@endsection
