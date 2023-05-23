<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List User</title>
</head>
<body>
    <h1>List User</h1>
    <p>Ini adalah halaman list user</p>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td style="padding-left: 2rem;">{{ $user->name }}</td>
                    <td style="padding-left: 2rem;">{{ $user->email }}</td>
                    <td style="padding-left: 2rem;">{{ $user->phone ?? '-' }}</td>
                    <td style="display: flex; gap: 0.5rem; margin-left:2rem;">
                        <a href="{{ route('user.edit', $user->id) }}">Edit</a>
                        <form action="{{ route('user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data</td>
                </tr>
            @endforelse
    </table>
</body>
</html>
