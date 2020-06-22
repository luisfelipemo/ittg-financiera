<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use DB;

class PaymentsController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('id')->get();
        return view('payments.index',[
            'payments' => $payments,
        ]);
        return view ('payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($loan_id)
    {
        $p = DB::table('loans')->join('clients', 'loans.client_id', '=', 'clients.id')
                    ->select('loans.id as prestamo', 'clients.name as cliente')
                    ->where('loans.id', '=', $loan_id)
                    ->first();
        return view('payments.create', compact('p'));
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
            'loan_id'  => 'required',
            'date_payment' => 'required',
            'received_amount' => 'required'
        ]);
        $loan_id = $request->input('loan_id');
        $received = $request->input('received_amount');
        $payments = Payment::select('received_amount')->where('loan_id', '=', $loan_id)->get();
        $payment_number = $payments->count() + 1;
        $loan = DB::table('loans')->select('quota', 'total')->where('id', '=', $loan_id)->first();
        $amount = $loan->quota;
        $paid = $payments->sum('received_amount') + $received;
        
        Payment::create([
            'loan_id'  => $loan_id,
            'payment_number' => $payment_number,
            'amount' => $amount,
            'date_payment' => $request->input('date_payment'),
            'received_amount' => $received,
        ]);
        
        if($paid == $loan->total){
            return redirect()->route('loans.status', $loan_id);
        }
        else{
            return redirect()->route('loans.show', $loan_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
