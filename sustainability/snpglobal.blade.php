@extends('layouts.vertical', ['title' => 'S&P Global'])

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">DSNG S&P Global Ranking</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">ESG Ranking</a></li>
                <li class="breadcrumb-item active">S&P Global</li>
            </ol>
        </div>
    </div>

@php
    $groupedByKategori = collect($ranking)->groupBy('kategori');
@endphp

<div class="row">
@foreach ($groupedByKategori as $kategori => $rows)
   <div class="col-xl-4 col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{$kategori}}</h5>
            </div>
			      <div class="card-body">
                <div class="table-responsive">
 <table class="table table-striped mb-0">
 <thead class="table-dark">

            <tr>
                <th>{{$kategori}}</th>
                <th>Skor 2024</th>
                <th>Skor 2023</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $row['sub_kategori'] }}</td>
                    <td>{{ $row['skor_2024'] }}</td>
                    <td>{{ $row['skor_2023'] }}</td>
                </tr>
            @endforeach
    </tbody>    
 </table>
        </div>
</div>
</div></div>
@endforeach
	</div>

<div class="row">
   <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Non Plantation Company 2024</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Perusahaan</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
 @foreach ($dataNonPlantation as $perusahaan => $records)
        <tr class="{{ $perusahaan == 'PT Dharma Satya Nusantara Tbk' ? 'table-primary' : '' }}">

                            <td>{{ $perusahaan }}</td>
                            <td>
                                @foreach ($records as $row)
                                    {{ $row->skor }}@if (!$loop->last), @endif
								 @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
</div></div>
  <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Plantation 2024 (* data 2023)</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table class="table  mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Perusahaan</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPlantation as $perusahaan => $records)
					  <tr class="{{ $perusahaan == 'PT Dharma Satya Nusantara Tbk' ? 'table-primary' : '' }}">

                            <td>{{ $perusahaan }}</td>
                            <td>
                                @foreach ($records as $row)
                                    {{ $row->skor }}@if (!$loop->last), @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div></div>
 
    <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Peer Comparison</h5>
                </div>
                <div class="card-body">
                    <div id="bar-chart"></div> 
                </div>
            </div>  
		  </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"> </script>

         <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 400
            },
            title: {
                text: 'Skor Perusahaan (Plantation) - 2024',
                align: 'center'
            },
            xaxis: {
                categories: @json($categories),
                title: { text: 'Perusahaan' },
                labels: { rotate: -45 }
            },
            yaxis: {
                title: { text: 'Skor' },
                min: 0,
                max: 100
            },
            dataLabels: {
				           enabled: true
            },
            series: [{
                name: 'Skor',
                data: @json($scores)
            }]
        };

        new ApexCharts(document.querySelector("#bar-chart"), options).render();
    </script>

@include('documents.indexsja', ['supportingdoc' => $supportingdoc])
@endsection
