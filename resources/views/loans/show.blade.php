@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{ __('Loan to: ').$loan->client }}</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('payments.create', $loan->id) }}" class="btn btn-success text-right">
                        {{ __('Pay')}}
                    </a>
                    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning">
                        {{ __('Edit Loan')}}
                    </a>
                    @if($loan->finished == true)
                    <button class="btn btn-outline-danger btn-delete" data-id="{{ $loan->id }}">{{ __('Delete') }}</button>
                    @endif
                    <a href="{{ route('clients.show', $loan->client_id) }}" class="btn btn-danger">
                        {{ __('Go Back')}}
                    </a>
                </div>
                <hr>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>{{ __('Ministering Date')}}</th>
                            <th>{{ $loan->ministering_date}}</th>
                        </tr>
                        <tr>
                            <th>{{ __('Due Date')}}</th>
                            <th>{{ $loan->due_date}}</th>
                        </tr>
                        <tr>
                            <th>{{ __('Amount')}}</th>
                            <th>${{ $loan->amount}}</th>
                        </tr>
                        <tr>
                            <th>{{ __('Interest')}}</th>
                            <th>${{ $loan->total - $loan->amount}}</th>
                        </tr>
                        <tr>
                            <th>{{ __('Total')}}</th>
                            <th>${{ $loan->total}}</th>
                        </tr>
                        <tr>
                            <th>{{ __('Number of payments')}}</th>
                            <th>{{ $loan->payments_n}}</th>
                        </tr>
                        <tr>
                            <th>{{ __('Status')}}</th>
                            @if($loan->finished == false)
                            <th>{{ __('Deuda activa')}}</th>
                            @else
                            <th>{{ __('Deuda saldada')}}</th>
                            @endif
                        </tr>
                    </tbody>

                </table>
                <table class="table table-hover table-bordered">
                    <thead class="thead-cardfelipe">
                        <tr>
                            <th scope="col">{{ __('Payment Number') }}</th>
                            <th scope="col">{{ __('Initial Balance') }}</th>
                            <th scope="col">{{ __('Quota') }}</th>
                            <th scope="col">{{ __('Payment') }}</th>
                            <th scope="col">{{ __('Due Date') }}</th>
                            <th scope="col">{{ __('Total Payment') }}</th>
                            <th scope="col">{{ __('Final Balance') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">0</th>
                            <td scope="col"></th>
                            <td scope="col"></th>
                            <td scope="col"></th>
                            <td scope="col"></th>
                            <td scope="col"></th>
                            <td scope="col">${{ $loan->total }}</th>
                        </tr>
                        
                        @for($i = 1; $i <= $loan->payments_n; $i++)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td scope="col">${{ $loan->total - (($i - 1)  * $loan->quota) }}</th>
                            <td scope="col">${{ $loan->quota }}</th>
                            @if(($payment - (($i - 1)  * $loan->quota)) > $loan->quota)
                            <td scope="col">${{ $loan->quota }}</th>
                            @elseif((($payment - (($i - 1)  * $loan->quota)) <= $loan->quota) && (($payment - (($i - 1)  * $loan->quota)) > 0))
                            <td scope="col">${{ $payment - (($i - 1)  * $loan->quota) }}</th>
                            @else
                            <td scope="col"></th>
                            @endif
                            <td scope="col">{{ Carbon::parse($loan->ministering_date)->addWeeks($i)->format('Y-m-d') }}</th>
                            <td scope="col">${{ $i * $loan->quota }}</th>
                            <td scope="col">${{ $loan->total - ($i * $loan->quota) }}</th>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('bottom-js')
<script>
    $('body').on('click', '.btn-delete', function(event) {
        const id = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás revertir esta acción',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borralo!'
        })
        .then((result) => {
            if (result.value) {
                axios.delete('{{ route('loans.index') }}/' + id)
                    .then(result => {
                        Swal.fire({
                            title: 'Borrado',
                            text: 'El préstamos ha sido borrado',
                            icon: 'success'
                        }).then(() => {
                            window.location.href='{{ route('loans.index') }}';
                        });
                    })
                    .catch(error => {
                        Swal.fire(
                            'Ocurrió un error',
                            'El cliente no ha podido borrarse.',
                            'error'
                        );
                    });

            }
        });
    });
</script>
@endsection