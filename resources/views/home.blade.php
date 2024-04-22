@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Total Customers') }}</div>

                    <div class="card-body">
                        {{ App\Models\User::where('user_role', 3)->count() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Total Trainers') }}</div>

                    <div class="card-body">
                        {{ App\Models\User::where('user_role', 2)->count() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Total Suscription Amount') }}</div>

                    <div class="card-body">
                        Rs. {{ App\Models\Suscription::sum('total_paid_amount') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        {!! $chart1->renderHtml() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        {!! $chart2->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after_scripts')
    {!! $chart1->renderChartJsLibrary() !!}

    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
@endpush
