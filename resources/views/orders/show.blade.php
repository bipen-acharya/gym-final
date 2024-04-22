@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Order Details</h1>
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td>{{ $order->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Customer Email</th>
                        <td>{{ $order->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>Rs. {{ $order->total }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $order->date }}</td>
                    </tr>
                    <tr>
                        <th>Items</th>
                        <td>
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                                @foreach ($order->products as $p)
                                    <tr>
                                        <td>{{ $p->name }}</td>
                                        <td>Rs.{{ $p->price }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
