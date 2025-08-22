@extends('layouts.vertical', ['title' => 'SPOTT Ranking'])

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">SPOTT Ranking</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">SPOTT Ranking</a></li>
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
                    <div id="spottChart2"></div> 
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">DSNG Spott Ranking Table</h5>
            </div>

            <div class="card-body">

                <table  class="table table-bordered dt-responsive table-responsive">

<thead class="table-dark">
            <tr>
                <th>Keterangan</th>
				      @foreach ($tahun as $th)
                    <th>{{ $th }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Skor</strong></td>
                @foreach ($skor as $s)
                    <td>{{ $s }}</td>
                @endforeach
            </tr>
            <tr>
                <td><strong>Peringkat</strong></td>
                @foreach ($peringkat as $p)
                    <td>{{ $p }}</td>
                @endforeach
            </tr>
        </tbody>


</table>

            </div>
        </div>
    </div>
	</div>
@include('documents.indexsja', ['supportingdoc' => $supportingdoc])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"> </script>
<script>
var options = {
    series: [{
        name: 'Peringkat',
        data: @json($peringkat)
    }],
    chart: {
        type: 'bar',
        height: 300
    },
     title: {
            text: 'Peringkat SPOTT DSNG',
            align: 'center'
        },
    plotOptions: {
        bar: {
            horizontal: true,
            barHeight: '60%',
        }
    },
	 dataLabels: {
        enabled: true
    },
    xaxis: {
        categories: @json($tahun), 
        title: {
            text: 'Peringkat'
        }
    },
    colors: ['#00aaff']
};

var chart = new ApexCharts(document.querySelector("#spottChart2"), options);
chart.render();

</script>

<script>
    var options = {
        chart: {
            type: 'line',
            height: 300
        },
        title: {
            text: 'Skor SPOTT DSNG',
            align: 'center'
        },
        xaxis: {
            categories: @json(array_reverse($tahun)),
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
            name: 'skor',
            data: @json(array_reverse($skor))
        }]
    };

    var chart = new ApexCharts(document.querySelector("#spott_skor"), options);
    chart.render();
</script>
    

<script>
    var options = {
        chart: {
            type: 'line',
            height: 300
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