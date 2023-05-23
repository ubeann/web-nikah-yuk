<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dummy Page</title>
</head>
<body>
    <h1>Dummy Page</h1>
    <p>Ini adalah halaman dummy</p>
    <hr>
    @forelse ($data as $label => $value)
        <p>{{ $label }}: {{ $value }}</p>
    @empty
        <p>Tidak ada data</p>
    @endforelse
</body>
</html>
