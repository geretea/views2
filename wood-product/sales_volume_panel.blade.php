@extends('layouts.vertical', ['title' => 'WP Sales Panel'])

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
        <h4 class="fs-18 fw-semibold m-0">Sales Volume Panel</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>
</div>

<!-- Datatables -->
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sales Volume Panel</h5>
            </div>

            <div class="card-body">

				  <table class="table table-bordered dt-responsive table-responsive">
                  <thead>
            <tr>
            <th>Jenis</th>
            @for ($year = 2024; $year >= 2020; $year--)
                <th>{{ $year }}</th>
            @endfor
        </tr>

            <tbody>
        @foreach ($groupedData as $produk => $jenis)
            @foreach ($jenis as $jenis => $data)
                <tr>
               
                    <td>{{ $jenis }} (m3)</td>
                    @for ($year = 2024; $year >= 2020; $year--)
                        <td>
                            {{ number_format(optional($data->firstWhere('tahun', $year))->total_aktual_sales, 0) ?? '-' }}
                        </td>
                    @endfor
                </tr>
            @endforeach
        @endforeach


        <tr>
        <td><strong> Total (m3)</strong></td>
        @for ($year = 2024; $year >= 2020; $year--)
            <td><strong> 
                @php
                    $yearTotal = $groupedData->flatten(1)->sum(function($data) use ($year) {
                        return optional($data->firstWhere('tahun', $year))->total_aktual_sales ?? 0;
                    });
                @endphp
                {{ number_format($yearTotal, 0) }}</strong>
            </td>
        @endfor
        <td><strong>
            @php
                $grandTotal = $groupedData->flatten(1)->sum(function($data) {
                    return $data->sum('total_aktual_sales');
                });
            @endphp </strong>
        </td>
    </tr>
    </tbody>
</table>

			
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sales Revenue Panel</h5>
            </div>

            <div class="card-body">

				  <table class="table table-bordered dt-responsive table-responsive">
                  <thead>
            <tr>
            <th>Jenis</th>
            @for ($year = 2024; $year >= 2020; $year--)
                <th>{{ $year }}</th>
            @endfor
        </tr>

            <tbody>
        @foreach ($groupedData as $produk => $jenis)
            @foreach ($jenis as $jenis => $data)
                <tr>
               
                    <td>{{ $jenis }} (Rp juta)</td>
                    @for ($year = 2024; $year >= 2020; $year--)
                        <td>
                            {{ number_format(optional($data->firstWhere('tahun', $year))->total_aktual_revenue, 0) ?? '-' }}
                        </td>
                    @endfor
                </tr>
            @endforeach
        @endforeach


        <tr>
        <td><strong> Total (Rp juta)</strong></td>
        @for ($year = 2024; $year >= 2020; $year--)
            <td><strong> 
                @php
                    $yearTotal = $groupedData->flatten(1)->sum(function($data) use ($year) {
                        return optional($data->firstWhere('tahun', $year))->total_aktual_revenue ?? 0;
                    });
                @endphp
                {{ number_format($yearTotal, 0) }}</strong>
            </td>
        @endfor
        <td><strong>
            @php
                $grandTotal = $groupedData->flatten(1)->sum(function($data) {
                    return $data->sum('total_aktual_revenue');
                });
            @endphp </strong>
        </td>
    </tr>
    </tbody>
</table>

</div>
        </div>
    </div>


<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Panel Average Selling</h5>
            </div>

            <div class="card-body">

				  <table class="table table-bordered dt-responsive table-responsive">
                  <thead>
            <tr>
            <th>Jenis</th>
            @for ($year = 2024; $year >= 2020; $year--)
                <th>{{ $year }}</th>
            @endfor
        </tr>

            <tbody>
        @foreach ($groupedData as $produk => $jenis)
            @foreach ($jenis as $jenis => $data)
                <tr>
               
                    <td>{{ $jenis }} (Rp /m3)</td>
                    @for ($year = 2024; $year >= 2020; $year--)
                        <td>
                        @php
                            $sales = optional($data->firstWhere('tahun', $year))->total_aktual_sales;
                            $revenue = optional($data->firstWhere('tahun', $year))->total_aktual_revenue;
                        
                            $asp = $sales > 0 ? 1000000*$revenue / $sales : 0;

                        @endphp
                        {{ number_format($asp) }}                         </td>
                    @endfor
                </tr>
            @endforeach
        @endforeach


        <tr>
        <td><strong> Total (Rp /m3)</strong></td>
        @for ($year = 2024; $year >= 2020; $year--)
            <td><strong> 
                @php
                    $totalSales = $groupedData->flatten(1)->sum(function($data) use ($year) {
                     return optional($data->firstWhere('tahun', $year))->total_aktual_sales ?? 0;
                     });
                                         
                     $totalRevenue = $groupedData->flatten(1)->sum(function($data) use ($year) {
                     return optional($data->firstWhere('tahun', $year))->total_aktual_revenue ?? 0;
                    });
                    $totalASP = $totalSales > 0 ? 1000000*$totalRevenue / $totalSales : 0;

                @endphp
                {{ number_format($totalASP, 0) }}</strong>
            </td>
        @endfor
  
    </tr>
    </tbody>
</table>


           </div>
        </div>
    </div>
    
</div>
@endsection


@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection
