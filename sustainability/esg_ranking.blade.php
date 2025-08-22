@extends('layouts.vertical', ['title' => 'ESG Ranking'])

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">ESG Ranking</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">ESG Ranking</a></li>
                <li class="breadcrumb-item active">Sustainability</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">SPOTT Ranking</h5>
                </div>
                <div class="card-body">
                    <div id="spott_peringkat"></div> 
                </div>
            </div>  
        </div>
		  <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">SPOTT Skor</h5>
                </div>
                <div class="card-body">
                    <div id="spott_skor"></div> 
                </div>
            </div>  
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"> </script>
         <script src="https://code.highcharts.com/highcharts.js"></script>

         <script src="https://code.highcharts.com/modules/exporting.js"></script>


<script>
    var options = {
        chart: {
            type: 'line',
            height: 350
        },
        title: {
			   text: 'Skor SPOTT DSNG',
            align: 'center'
        },
        xaxis: {
            categories: @json($tahun),
            title: {
                text: 'Tahun'
            }
        },
        yaxis: {
            title: {
                text: 'Skor'
            },
            min: 0,
            max: 100
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(1); 
            },
            offsetY: -10,
            style: {
                fontSize: '12px',
                colors: ["#000"]
            }
			  },
        markers: {
            size: 5
        },
        series: [{
            name: 'Skor',
            data: @json($skor)
        }]
    };

    var chart = new ApexCharts(document.querySelector("#spott_skor"), options);
    chart.render();
</script>


<script>
    var options = {
        chart: {
            type: 'line',
            height: 350
        },
        title: {
            text: 'Peringkat SPOTT DSNG',
            align: 'center'
        },
        xaxis: {
			   categories: @json($tahun),
            title: {
                text: 'Tahun'
            }
        },
        yaxis: {
            title: {
                text: 'Peringkat'
            },
            min: 0,
            max: 100
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(1); 
            },
            offsetY: -10,
            style: {
                fontSize: '12px',
                colors: ["#000"]
            }
        },
        markers: {
            size: 5
        },
		    series: [{
            name: 'Peringkat',
            data: @json($peringkat)
        }]
    };

    var chart = new ApexCharts(document.querySelector("#spott_peringkat"), options);
    chart.render();
</script>

@endsection