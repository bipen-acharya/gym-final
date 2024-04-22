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
                                <th>Valid From</th>
                                <th>Valid Till</th>
                                <th>Plan Name</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th></th>
                            </tr>
                            @foreach ($suscriptions as $o)
                                <tr>
                                    <td>
                                        {{ $o->id }}
                                    </td>
                                    <td>{{ $o->user->name }}</td>
                                    <td>{{ $o->user->email }}</td>
                                    <td>{{ $o->valid_from }}</td>
                                    <td>{{ $o->valid_till }}</td>
                                    <td>{{ $o->plan_name }}</td>
                                    <td>{{ $o->total_paid_amount }}</td>
                                    <td>{{ $o->payment_method }}</td>
                                    <td>
                                        <form action="{{ route('suscriptions.destroy', $o->id) }}" method="POST">
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
