@extends('layouts.vertical', ['title' => 'Wilayah Penempatan Tenaga Kerja'])

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
        <h4 class="fs-18 fw-semibold m-0">Human Capital</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Human Capital</a></li>
            <li class="breadcrumb-item active">Penempatan Tenaga Kerja</li>
        </ol>
    </div>
</div>
<!-- Barchart -->
<div class="card"><div class="card-body">
                <h4 class="card-title mb-0">Chart Penempatan berdasarkan Wilayah & Gender</h4>
</div></div>

<div class="row">
    @foreach ([2022, 2023, 2024] as $tahun)
        <div class="col-md-4">
<div class="card">
            <div class="card-body">
            <h5 class="text-center">{{ $tahun }}</h5>
            <canvas id="barChart{{ $tahun }}" height="300"></canvas>
        </div></div></div>
    @endforeach

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const wilayah = @json($wilayah);

    const barData = {
        2022: {
            laki_laki: @json($barChart[2022]['laki_laki']),
            perempuan: @json($barChart[2022]['perempuan']),
        },
        2023: {
            laki_laki: @json($barChart[2023]['laki_laki']),
            perempuan: @json($barChart[2023]['perempuan']),
        },
        2024: {
            laki_laki: @json($barChart[2024]['laki_laki']),
            perempuan: @json($barChart[2024]['perempuan']),
        }
    };

    [2022, 2023, 2024].forEach(tahun => {
        const ctx = document.getElementById('barChart' + tahun).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                    labels: wilayah,
                datasets: [
                    {
                        label: 'Laki-laki',
                        data: barData[tahun].laki_laki,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    },
                    {
                        label: 'Perempuan',
                        data: barData[tahun].perempuan,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: false
                    },
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                     y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>


<!--Pie-->
<div class="card"><div class="card-body">
                <h4 class="card-title mb-0">Perbandingan Penempatan berdasarkan Gender (2024)</h4>
</div></div>


<div class="row">
    @foreach ($pieWilayah as $p)
        <div class="col-md-3">
<div class="card">
            <div class="card-body">
            <h6 class="text-center">{{ $p->wilayah }}</h6>
            <canvas id="pie{{ $loop->index }}"></canvas>
              <script>
                const pieCtx{{ $loop->index }} = document.getElementById('pie{{ $loop->index }}');
                new Chart(pieCtx{{ $loop->index }}, {
                    type: 'pie',
                    data: {
                        labels: ['Laki-laki', 'Perempuan'],
                        datasets: [{
                            data: [{{ $p->laki_laki ?? 0 }}, {{ $p->perempuan ?? 0 }}],
                            backgroundColor: ['#36A2EB', '#FF6384']
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Tahun 2024'
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            </script>
              </div>

        {{-- Baris baru setiap 3 kolom --}}
        @if(($loop->iteration % 3) == 0)
            </div>
<div class="row">
        @endif
</div></div>
    @endforeach
</div>


<!--Datatables -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tenaga Kerja Berdasarkan Penempatan Wilayah</h5>
            </div>

            <div class="card-body">


                <table class="table table-bordered dt-responsive table-responsive">
                      <thead class="table-dark">
        <tr>
            <th rowspan="2">Wilayah</th>
            <th colspan="3">2024</th>
            <th colspan="3">2023</th>
            <th colspan="3">2022</th>
        </tr>
        <tr>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Jumlah</th>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Jumlah</th>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grouped as $wilayah => $tahunData)
            <tr>
                <td>{{ $wilayah }}</td>
                {{-- Tahun 2024 --}}
                        <td>{{ $tahunData['2024']->laki_laki ?? '-' }}</td>
                <td>{{ $tahunData['2024']->perempuan ?? '-' }}</td>
                <td>
                    {{ isset($tahunData['2024']) ? $tahunData['2024']->laki_laki + $tahunData['2024']->perempuan : '-' }}
                </td>

                {{-- Tahun 2023 --}}
                <td>{{ $tahunData['2023']->laki_laki ?? '-' }}</td>
                <td>{{ $tahunData['2023']->perempuan ?? '-' }}</td>
                <td>
                    {{ isset($tahunData['2023']) ? $tahunData['2023']->laki_laki + $tahunData['2023']->perempuan : '-' }}
                </td>

                {{-- Tahun 2022 --}}
                <td>{{ $tahunData['2022']->laki_laki ?? '-' }}</td>
                <td>{{ $tahunData['2022']->perempuan ?? '-' }}</td>
                <td>
                    {{ isset($tahunData['2022']) ? $tahunData['2022']->laki_laki + $tahunData['2022']->perempuan : '-' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>    </div>
        </div>
    </div>
</div>
@include('hcdocs.index', ['HC_supportingdoc' => $HC_supportingdoc])

@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
