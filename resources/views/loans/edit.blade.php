@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{ __('Edit Loan') }}</h3>
                    </div>
                    <div>
                        <a href="{{ route('loans.index') }}" class="btn btn-danger">
                            {{ __('Cancel')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('loans.update', $loan->id) }}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-12">
                            <label for="client_id">{{ __('Client') }}</label>
                            <select class="form-control" name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror">
                                <option value="{{ $loan->client_id }}">{{ $loan->client }}</option>
                            </select>
                            @error('client_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">
                    @csrf
                    @method('PUT')
                        <div class="col-md-6">
                            <label for="amount">{{ __('Amount') }}</label>
                            <input type="number" name="amount" id="amount" value="{{ $loan->amount }}" class="form-control @error('amount') is-invalid @enderror">
                            @error('amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="payments_n">{{ __('Payments Number') }}</label>
                            <input type="number" name="payments_n" id="payments_n" value="{{ $loan->payments_n }}" class="form-control @error('payments_n') is-invalid @enderror">
                            @error('payments')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="quota">{{ __('Quota') }}</label>
                            <input type="number" name="quota" id="quota" value="{{ $loan->quota }}" class="form-control @error('quota') is-invalid @enderror">
                            @error('quota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="total">{{ __('Total') }}</label>
                            <input type="number" name="total" id="total" value="{{ $loan->total }}" class="form-control @error('total') is-invalid @enderror">
                            @error('total')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="ministering_date">{{ __('Ministering Date') }}</label>
                            <input type="date" name="ministering_date" id="ministering_date" value="{{ $loan->ministering_date }}" class="form-control @error('ministering_date') is-invalid @enderror">
                            @error('ministering_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="due_date">{{ __('Due Date') }}</label>
                            <input type="date" name="due_date" id="due_date" value="{{ $loan->due_date }}" class="form-control @error('due_date') is-invalid @enderror">
                            @error('due_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

