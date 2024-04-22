@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('users.create') }}" class="btn btn-success">Add New</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type/Role</th>
                                <th></th>
                            </tr>
                            @foreach ($users as $p)
                                <tr>
                                    <td>
                                        {{ $p->id }}
                                    </td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ App\Models\User::$roles[$p->user_role] }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $p->id) }}" class="btn btn-info">Edit</a>
                                        <form action="{{ route('users.destroy', $p->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
