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
            
        </tr>
        @endforeach
    </tbody>
</table>