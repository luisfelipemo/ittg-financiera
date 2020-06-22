@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{ __('Client: ').$client->name }}</h3>
                    </div>
                    <div>
                        <a href="{{ route('loans.create', $client->id) }}" class="btn btn-info">
                                    {{ __('New Loan') }}
                                </a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">
                            {{ __('Edit Client')}}
                        </a>
                        <a href="{{ route('clients.index') }}" class="btn btn-danger">
                            {{ __('Go Back')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul>
                    <li>{{ __('Name: ').$client->name }}</li>
                    <li>{{ __('Phone: ').$client->phone }}</li>
                    <li>{{ __('Address: ').$client->address }}</li>
                </ul>
                @if($loans->count())
                <h4>{{ ('Loans' )}}</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Amount') }}</th>
                            <th scope="col">{{ __('Status')}}</th>
                            <th scope="col" style="width: 150px">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $item)
                        <tr>
                            <td>${{ $item->amount }}</td>
                            @if($item->finished == false)
                            <td>{{ __('Deuda activa')}}</td>
                            @else
                            <td>{{ __('Deuda saldada')}}</td>
                            @endif
                            <td>
                                <a href="{{ route('loans.show', $item->id) }}" class="btn btn-outline-secondary btn-sm">
                                    {{ __('Show') }}
                                </a>
                                <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $item->id }}">{{ __('Delete') }}</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <b>{{ __('No ha recibido ningún préstamo')}}</b>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection