@extends('layouts.vertical', ['title' => 'Sales CPO'])

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
<style>
    .chart-auto-height {
        width: 100% !important;
    }
</style>
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Sales CPO</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
                     <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>
</div>

<!-- Chart dan Tabel-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Sales CPO per PT</h5>
            </div>

<div class="card-body">

    <form method="GET" class="row g-3 mb-4" id="filterForm">
        <div class="col-md-3">
            <label for="pks" class="form-label">Pilih PT</label>
            <select class="form-select" name="perusahaan" id="perusahaan">
                <option value="all" {{ request('perusahaan', 'all') == 'all' ? 'selected' : '' }}>All PT</option>
                @foreach($allPerusahaan as $perusahaan)
                    <option value="{{ $perusahaan }}" {{ request('perusahaan', 'all') == $perusahaan ? 'selected' : '' }}>{{ $perusahaan }}</option>
                @endforeach
            </select>
        </div>
         <div class="col-md-3">
            <label for="mode" class="form-label">Mode</label>
            <select class="form-select" name="mode" id="mode">
                <option value="bulanan" {{ request('mode', 'bulanan') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                <option value="tahunan" {{ request('mode', 'bulanan') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
            </select>
        </div>
        <div class="col-md-3 tahun-group" id="tahun-group">
            <label for="tahun" class="form-label">Tahun</label>
            <select class="form-select" name="tahun" id="tahun">
                @for($y = $latestYear; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun', $latestYear) == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3 tahun-akhir-group d-none" id="tahun-akhir-group">
            <label for="tahun_akhir" class="form-label">Tahun Akhir</label>
            <select class="form-select" name="tahun_akhir" id="tahun_akhir">
                @for($y = $latestYear; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun_akhir', $latestYear) == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                   </div>

<div class="row">
   <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sales Volume CPO {{ request('perusahaan', 'all') != 'all' ? ' - ' . request('perusahaan') : '' }}
{{ request('mode', 'bulanan') == 'tahunan' ? ' (' . request('tahun', $latestYear) . '–' . request('tahun_akhir', $latestYear) . ')' : ' (' . request('tahun', $latestYear) . ')' }}
</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChartCPO_Volume"></canvas> 
                </div>
            </div>  
        </div>
   <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sales Revenue CPO {{ request('perusahaan', 'all') != 'all' ? ' - ' . request('perusahaan') : '' }}
{{ request('mode', 'bulanan') == 'tahunan' ? ' (' . request('tahun', $latestYear) . '–' . request('tahun_akhir', $latestYear) . ')' : ' (' . request('tahun', $latestYear) . ')' }}
</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChartCPO_Revenue"></canvas> 
                </div>
            </div>  
        </div>
        <div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Total Sales Volume CPO  {{ request('perusahaan', 'all') != 'all' ? ' - ' . request('perusahaan') : '' }}
{{ request('mode', 'bulanan') == 'tahunan' ? ' (' . request('tahun', $latestYear) . '–' . request('tahun_akhir', $latestYear) . ')' : ' (' . request('tahun', $latestYear) . ')' }}
</h5>       </div>

            <div class="card-body">
                    <table class="table table-bordered dt-responsive text-end">
            <thead class="table-light">
                <tr>
                    <th class="text-start">{{ request('mode', 'bulanan') == 'tahunan' ? 'Tahun' : 'Bulan' }}</th>
                    <th>Sales Volume</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labels as $i => $label)
                <tr>
                    <td class="text-start">{{ $label }}</td>
                    <td>{{ number_format($salesTotal_Volume[$i], 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr class="table-secondary">
                    <th class="text-start">
                        Total {{ request('mode', 'bulanan') == 'tahunan' ? request('tahun', $latestYear).'–'.request('tahun_akhir', $latestYear) : '' }}
                    </th>
                    <th>{{ number_format(array_sum($salesTotal_Volume), 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>

     <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Total Sales Revenue CPO  {{ request('perusahaan', 'all') != 'all' ? ' - ' . request('perusahaan') : '' }}
{{ request('mode', 'bulanan') == 'tahunan' ? ' (' . request('tahun', $latestYear) . '–' . request('tahun_akhir', $latestYear) . ')' : ' (' . request('tahun', $latestYear) . ')' }}
</h5>       </div>

            <div class="card-body">
                    <table class="table table-bordered dt-responsive text-end">
            <thead class="table-light">
                <tr>
                    <th class="text-start">{{ request('mode', 'bulanan') == 'tahunan' ? 'Tahun' : 'Bulan' }}</th>
                    <th>Sales Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labels as $i => $label)
                <tr>
                    <td class="text-start">{{ $label }}</td>
                    <td>{{ number_format($salesTotal_Revenue[$i], 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr class="table-secondary">
                    <th class="text-start">
                        Total {{ request('mode', 'bulanan') == 'tahunan' ? request('tahun', $latestYear).'–'.request('tahun_akhir', $latestYear) : '' }}
                    </th>
                    <th>{{ number_format(array_sum($salesTotal_Revenue), 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sales Volume CPO {{ request('perusahaan', 'all') != 'all' ? ' - ' . request('perusahaan') : '' }}
{{ request('mode', 'bulanan') == 'tahunan' ? ' (' . request('tahun', $latestYear) . '–' . request('tahun_akhir', $latestYear) . ')' : ' (' . request('tahun', $latestYear) . ')' }}
                        </h5> 
                        </div>                   
    <div class="card-body">
                    <canvas id="lineChartCPO_Volume"></canvas> 
                </div>
            </div>  
        </div>
<div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sales Revenue CPO {{ request('perusahaan', 'all') != 'all' ? ' - ' . request('perusahaan') : '' }}
{{ request('mode', 'bulanan') == 'tahunan' ? ' (' . request('tahun', $latestYear) . '–' . request('tahun_akhir', $latestYear) . ')' : ' (' . request('tahun', $latestYear) . ')' }}
                        </h5> 
                        </div>                   
    <div class="card-body">
                    <canvas id="lineChartCPO_Revenue"></canvas> 
                </div>
            </div>  
        </div>
</div>

</div>
<script>
    function adjustChartHeight() {
        const table = document.getElementById('dataTableResult');
        const tableHeight = table ? table.offsetHeight : 300;

        document.querySelectorAll('.chart-auto-height').forEach(canvas => {
                       canvas.height = tableHeight;
        });
    }

    window.addEventListener('load', adjustChartHeight);
    window.addEventListener('resize', adjustChartHeight);
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);
    const salesTotal_Volume = @json($salesTotal_Volume);
    const salesTotal_Revenue = @json($salesTotal_Revenue);

    new Chart(document.getElementById('barChartCPO_Volume'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales Volume CPO',
                data: salesTotal_Volume,
                backgroundColor: '#548120ff'
            }]
        },
        options: {
              responsive: true,
            plugins: { legend: { display: false } }
        }
    });

  new Chart(document.getElementById('barChartCPO_Revenue'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales Revenue CPO',
                data: salesTotal_Revenue,
                backgroundColor: '#0459a8ff'
            }]
        },
        options: {
              responsive: true,
            plugins: { legend: { display: false } }
        }
    });
    new Chart(document.getElementById('lineChartCPO_Volume'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Sales Volume CPO',
                    data: salesTotal_Volume,
                    borderColor: '#ff008cff',
                    backgroundColor: 'rgba(0,123,255,0.1)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: {
                y: {
                    beginAtZero: true
                                }
            }
        }
    });

  new Chart(document.getElementById('lineChartCPO_Revenue'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Sales Revenue CPO',
                    data: salesTotal_Revenue,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0,123,255,0.1)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: {
                y: {
                    beginAtZero: true
                                }
            }
        }
    });


    // Toggle tahun akhir saat mode tahunan
    document.getElementById('mode').addEventListener('change', function () {
        const isTahunan = this.value === 'tahunan';
        document.getElementById('tahun-akhir-group').classList.toggle('d-none', !isTahunan);
        document.getElementById('tahun-group').querySelector('label').innerText = isTahunan ? 'Tahun Awal' : 'Tahun';
    });

    // Trigger change event on page load to set correct visibility
    document.getElementById('mode').dispatchEvent(new Event('change'));
</script>
@endsection


@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection