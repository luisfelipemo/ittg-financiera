<?php

namespace App\Exports;

use App\Models\Loan;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SummaryExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $loans = Loan::join('clients', 'loans.client_id', '=', 'clients.id')
                    ->select('loans.*', 'clients.name as client')
                    ->get();
        $payments = DB::table('payments')->select('loan_id', 'received_amount')->get();
        return view('loans.summary', [
            'loans' => $loans,
            'payments' => $payments,
        ]);
    }
}
