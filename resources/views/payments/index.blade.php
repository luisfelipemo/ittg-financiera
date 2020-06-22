@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Pagos</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Client') }}</th>
                            <th scope="col">{{ __('Payment Number')}}</th>
                            <th scope="col">{{ __('Amount') }}</th>
                            <th scope="col">{{ __('Date payment') }}</th>
                            <th scope="col">{{ __('Received amount') }}</th>
                            <th scope="col" style="width: 150px">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $item)
                        <tr>
                            <td scope="row">{{ $item->id }}</td>
                            <td>{{ $item->loan_id }}</td>
                            <td>{{ $item->payment_number}}</td>
                            <td>${{ $item->amount }}</td>
                            <td>{{ $item->date_payment }}</td>
                            <td>${{ $item->received_amount }}</td>
                            <td>
                                <a href="" class="btn btn-outline-secondary btn-sm">
                                    Show
                                </a>
                                <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $item->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
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
                axios.delete('{{ route('payments.index') }}/' + id)
                    .then(result => {
                        Swal.fire({
                            title: 'Borrado',
                            text: 'Préstamo eliminado',
                            icon: 'success'
                        }).then(() => {
                            window.location.href='{{ route('payments.index') }}';
                        });
                    })
                    .catch(error => {
                        Swal.fire(
                            '¡Error!',
                            'No se ha podido borrar el client.',
                            'error'
                        );
                    });

            }
        });
    });
</script>
@endsection

