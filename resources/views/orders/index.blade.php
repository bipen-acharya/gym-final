@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            @foreach ($orders as $o)
                                <tr>
                                    <td>
                                        {{ $o->id }}
                                    </td>
                                    <td>{{ $o->user->name }}</td>
                                    <td>{{ $o->user->email }}</td>
                                    <td>{{ $o->total }}</td>
                                    <td>{{ $o->date }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $o->id) }}" class="btn btn-info">Show</a>
                                        <form action="{{ route('orders.destroy', $o->id) }}" method="POST">
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
