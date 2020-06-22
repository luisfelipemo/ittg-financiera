@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Préstamos</h3>
                    </div>
                    <div>
                        <a href="{{ route('loans.export') }}" class="btn btn-primary">
                            {{ __('Export')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($loans->count())
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Client') }}</th>
                            <th scope="col">{{ __('Borrowed Amount') }}</th>
                            <th scope="col">{{ __('Total to pay') }}</th>
                            <th scope="col">{{ __('Ministering date') }}</th>
                            <th scope="col">{{ __('Due date') }}</th>
                            <th scope="col">{{ __('Quota') }}</th>
                            <th scope="col">{{ __('Payments Number')}}</th>
                            <th scope="col">{{ __('Payments Made')}}</th>
                            <th scope="col">{{ __('Balanced paid') }}</th>
                            <th scope="col">{{ __('Balanced payable') }}</th>
                            <th scope="col">{{ __('Show') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loans)
                        <tr>
                            <th scope="row">{{ $loans->id }}</th>
                            <td>{{ $loans->client }}</td>
                            <td>${{ $loans->amount }}</td>
                            <td>${{ $loans->total}}</td>
                            <td>{{ $loans->ministering_date}}</td>
                            <td>{{ $loans->due_date}}</td>
                            <td>${{ $loans->quota}}</td>
                            
                            <td>{{ $loans->payments_n}}</td>
                            <td>@php echo $payments->where('loan_id', '=', $loans->id)->count(); @endphp</td>
                            <td>@php echo '$'.$payments->where('loan_id', '=', $loans->id)->sum('received_amount'); @endphp</td>
                            <td>@php $payable = $loans->total-$payments->where('loan_id', '=', $loans->id)->sum('received_amount'); echo '$'.$payable@endphp</td>
                            <td>
                                <a href="{{ route('loans.show', $loans->id) }}" class="btn btn-outline-secondary btn-sm">
                                    {{ __('Show') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @else
                <h5>{{ __('Nadie ha solicitado un préstamo') }}</h5>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
