<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $data->jenis_data }}</title>
</head>
<body>
    <h1>Detail for {{ ucfirst($data->jenis_data) }}</h1>
    <p>Kategori: {{ ucfirst($data->kategori) }}</p>
    <p>Sub Kategori: {{ ucfirst($data->sub_kategori) }}</p>
    <p>Reference Table: {{ $data->detail_data }}</p>

    <h2>Related Data:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($referenceData as $ref)
                <tr>
                    <td>{{ $ref->id }}</td>
                    <td>{{ $ref->detail_data }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('data.index') }}">Back to All Data</a>
</body>
</html>
