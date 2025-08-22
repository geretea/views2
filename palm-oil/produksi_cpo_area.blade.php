@extends('layouts.vertical', ['title' => 'Produksi CPO per Wilayah'])

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Produksi CPO</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Palm Oil</a></li>
                <li class="breadcrumb-item active">Kinerja Operasional</li>
            </ol>
        </div>
    </div>
<div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Produksi CPO Area {{ $area }} 10 Thn terakhir</h5>
                </div>
                <div class="card-body">
                    <div id="chartTahunan"></div> 
                </div>
            </div>  
        </div>

  <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Produksi CPO per PKS Area {{ $area }} Tahun {{ $tahunMax }}</h5>
                </div>
                <div class="card-body">
                    <div id="chartStacked"></div> 
                </div>
            </div>  
        </div>
    </div>


   <div class="row">
    <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Produksi CPO Tahun {{ $tahunMax }}</h5>
                </div>
                <div class="card-body">
                    <div id="chartbarhorizontal"></div> 
                </div>
            </div>  
        </div>
	      <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Perbandingan per Area</h5>
                </div>
                <div class="card-body">
                    <div id="chartPie"></div> 
                </div>
            </div>  
        </div>
    </div>

 <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Helper format Indonesia
    function formatID(value) {
        return Number(value).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
    }

    // Bulanan 2024
    new ApexCharts(document.querySelector("#chartBulanan"), {
        chart: { type: 'bar' },
        series: [{
            name: 'Produksi',
            data: @json($produksiBulanan->pluck('total'))
        }],
        xaxis: { categories: @json($produksiBulanan->pluck('bulan')) },
        yaxis: { labels: { show: false } }, 
        dataLabels: {
            enabled: false,
            formatter: function (val) {
                return formatID(val);
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return formatID(val);
                }
            }
        }
    }).render();

    // 10 tahun terakhir
    new ApexCharts(document.querySelector("#chartTahunan"), {
        chart: { type: 'line', 
				 stacked: false 
			   },
        colors: ['#008FFB', '#FF4560'],
       series: [
        {
            name: 'Produksi',
            type: 'bar',
            data: @json($produksiTahunan->pluck('total'))
        },
        {
            name: 'Trend',
            type: 'line',
            data: @json($produksiTahunan->pluck('total')) 
        }
    ],
		
		
        xaxis: { categories: @json($produksiTahunan->pluck('tahun')) },
        yaxis: { labels: { show: false } },
        dataLabels: {
            enabled: false,
            formatter: function (val) {
                return formatID(val);
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return formatID(val);
                }
            }
        }
    }).render();

    // Pie Chart wilayah 2024
    new ApexCharts(document.querySelector("#chartPie"), {
        chart: { type: 'pie' },
        series: @json($produksiPie->pluck('total')),
        labels: @json($produksiPie->pluck('area')),
        dataLabels: {
            formatter: function (val, opts) {
                let value = opts.w.globals.series[opts.seriesIndex];
                return formatID(value);
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return formatID(val);
                }
            }
        }
    }).render();
</script>
<script>
    var options = {
        chart: {
            type: 'bar',
            stacked: true,
            height: 300
        },
        series: [
            @foreach($produksiBulananPKS as $pks => $rows)
                {
                    name: '{{ $pks }}',
                    data: [
                        @foreach(range(1,12) as $bulan)
                            {{ $rows->firstWhere('bulan', $bulan)->total ?? 0 }},
                        @endforeach
                    ]
                },
            @endforeach
        ],
			  colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#3F51B5', '#546E7A', '#D4526E', '#8D5B4C', '#F86624'],
  legend: {
    position: 'top',
  },
        xaxis: {
            categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']
        },
			yaxis: {
    labels: {
        show: false
    }
},
        dataLabels: { enabled: false },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val.toLocaleString('id-ID');
                }
            }
        }
	
	
    };

    new ApexCharts(document.querySelector("#chartStacked"), options).render();
</script>
<script>
    var options = {
        chart: { type: 'bar', height: 340 },
        series: [{
            name: 'Produksi',
            data: @json($totalList)
        }],
        plotOptions: { bar: { horizontal: true, borderRadius: 4 } },
        xaxis: { 
            title: { text: 'Produksi (ton)' },
            labels: { show: true }
        },
        yaxis: { 
            categories: @json($pksList),
            labels: { formatter: function(val){ return val; } }
        },
        dataLabels: { enabled: false },
   		tooltip: {
            y: {
                formatter: function (val) {
                    return val.toLocaleString('id-ID');
                }
            }
        },   
		grid: { show: true }
    };

    new ApexCharts(document.querySelector("#chartbarhorizontal"), options).render();
</script>
@endsection


