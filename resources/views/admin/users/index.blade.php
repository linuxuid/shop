@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">      
    <link rel="stylesheet" href="{{ asset('/css/admin/users/index.css') }}"> 
@endsection

@section('content')
<main>
    <div class="content">
        <div class="top">
            <h2>Users list</h2>
        </div>
        <div class="users">
            <table>
                <tr>
                    <th>Register Date:</th>
                    <th>Name:</th>
                    <th>Username:</th>
                    <th>Email:</th>
                    <th>edit</th>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td class="email"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    <td class="edit"><a href="/control/users/{{ $user->id }}">change</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</main>
@endsection