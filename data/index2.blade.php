<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Index</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include your CSS -->
</head>
<body>
    <div class="container">
        <h1>Data for {{ ucfirst($kategori) }} - {{ ucfirst($sub_kategori) }}</h1>
        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($data->isEmpty())
            <p>No data found for the selected category and sub-category.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->sub_kategori }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>
