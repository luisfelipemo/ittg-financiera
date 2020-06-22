@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{ __('New Payment') }}</h3>
                    </div>
                    <div>
                        <a href="{{ route('loans.show', $p->prestamo) }}" class="btn btn-danger">
                            {{ __('Cancel')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-3">
                            <label for="loan_id">{{ __('Loan number') }}</label>
                            <input id="loan_id" name="loan_id" value="{{ $p->prestamo }}" readonly class="form-control @error('loan_id') is-invalid @enderror">
                            @error('loan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-9">
                            <label for="client">{{ __('Client') }}</label>
                            <input id="client" name="client" value="{{ $p->cliente }}" readonly class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="date_payment">{{ __('Date Payment') }}</label>
                            <input type="date" name="date_payment" id="date_payment" value="{{date('Y-m-d')}}" readonly class="form-control @error('date_payment') is-invalid @enderror">
                            @error('date_payment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="received_amount">{{ __('Received Amount') }}</label>
                            <input type="number" name="received_amount" id="received_amount" class="form-control @error('received_amount') is-invalid @enderror">
                            @error('received_amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
