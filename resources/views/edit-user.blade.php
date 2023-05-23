<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <p>Ini adalah halaman edit user</p>
    <hr>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Errors --}}
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}">

        <br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}">

        <br>

        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" value="{{ $user->phone }}">

        <br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <br>

        <button type="submit">Update</button>
</body>
</html>
