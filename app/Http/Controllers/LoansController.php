<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Exports\SummaryExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Carbon\Carbon;

class LoansController extends Controller
{
        public function export() 
        {
            return Excel::download(new SummaryExport, 'resumenPagos.xlsx');
        }
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $loans = Loan::join('clients', 'loans.client_id', '=', 'clients.id')
                        ->select('loans.*', 'clients.name as client')
                        ->get();
            $payments = DB::table('payments')->select('loan_id', 'received_amount')->get();
            
            return view('loans.index', [
                'loans' => $loans,
                'payments' => $payments,
            ]);
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create($client_id)
        {
            $client = DB::table('clients') -> select ('id','name') -> where('id', '=', $client_id)->first();
            return view('loans.create', compact('client'));
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $request->validate([
                'client_id'  => 'required',
                'amount' => 'required',
                'payments_n' => 'required',
                'quota' => 'required',
                'total' => 'required',
                'ministering_date' => 'required',
                //'due_date' => 'required',
            ]);
            $ministering = $request->input('ministering_date');
            $payments = $request->input('payments_n');
            $due_date = Carbon::parse($ministering)->addWeeks($payments);
    
            Loan::create([
                'client_id'  => $request->input('client_id'),
                'payments_n' => $request->input('payments_n'),
                'amount' => $request->input('amount'),
                'quota' => $request->input('quota'),
                'total' => $request->input('total'),
                'ministering_date' => $request->input('ministering_date'),
                'due_date' => $due_date,
                'finished' => false,
            ]);
    
            return redirect()->route('loans.index')->with('success','Préstamos otorgado correctamente');
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $loan = Loan::join('clients', 'loans.client_id', '=', 'clients.id')
                        ->select('loans.*', 'clients.name as client')
                        ->where('loans.id', '=', $id)
                        ->first();
            $payment = DB::table('payments')->select('received_amount')->where('loan_id', '=', $loan->id)->sum('received_amount');
            
            return view('loans.show', ['loan' => $loan, 'payment' => $payment]);
        }
    
        
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $loan = Loan::join('clients', 'loans.client_id', '=', 'clients.id')
                        ->select('loans.*', 'clients.name as client')
                        ->where('loans.id', '=', $id)
                        ->first();
            return view('loans.edit', ['loan' => $loan]);
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $data = $request->validate([
                'client_id'  => 'required',
                'amount' => 'required',
                'payments_n' => 'required',
                'quota' => 'required',
                'total' => 'required',
                'ministering_date' => 'required',
                'due_date' => 'required',
            ]);
            Loan::whereId($id)->update($data);
            return redirect('/loans')->with('success', 'Loan data is successfully updated');
        }
    
        public function status($id)
        {
            Loan::whereId($id)->update(['finished' => 1]);
            return redirect()->route('loans.show', $id);
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $loan = Loan::find($id);
            $loan->delete();
            return $loan;
        }
}
