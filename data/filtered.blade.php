@extends('layouts.vertical', ['title' => "Filtered Data by '$jenis_data'"])

@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Filtered Data for: {{ $jenis_data }}</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{ route('kebutuhan_data.index') }}">Back to Data Table</a></li>
            <li class="breadcrumb-item active">Filtered Data</li>
        </ol>
    </div>
</div>

<!-- Data Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filtered Data Table</h5>
            </div>

            <div class="card-body">
                <table class="table table-bordered dt-responsive table-responsive nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th>User</th>
                            <th>Tujuan Laporan</th>
                            <th>Jenis Data</th>
                            <th>Detail Data</th>
                            <th>Periode</th>
                            <th>Deadline</th>
                            <th>Penyedia Data</th>
                            <th>PIC</th>
                            <th>Status</th>
                            <th>URL</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->sub_kategori }}</td>
                                <td>{{ $item->user }}</td>
                                <td>{{ $item->tujuan_laporan }}</td>
                                <td>{{ $item->jenis_data }}</td>
                                <td>{{ $item->detail_data }}</td>
                                <td>{{ $item->periode }}</td>
                                <td>{{ $item->deadline }}</td>
                                <td>{{ $item->penyedia_data }}</td>
                                <td>{{ $item->pic }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->url }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
