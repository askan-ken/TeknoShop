<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.transactions.index', [
            'title' => 'Data Transaksi Anda',
            'transactions' => Transaction::with('purchases.product')->status(request('status'))->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    { 
        return view('pages.transactions.show', [
            'title' => 'Detail Transaksi',
            'transaction' => $transaction->load('purchases.product')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $rules = [
            'status' => 'required|in:dibatalkan,diproses,selesai',
            'payment' => 'image|file|max:5000'
        ];
        if ($request->file('payment') != null or $request->status == 'diproses') :
            $rules['payment'] = 'required|image|file|max:5000';
        endif;
        $validated = $request->validate($rules);
        if ($request->file('payment') != null or $request->status == 'diproses') :
            $validated['payment'] = $request->file('payment')->store('photos/payments');
        endif;
        Transaction::find($transaction->id)->update($validated);
        if ($request->file('payment') != null or $request->status == 'diproses') :
            $purchases = $transaction->purchases;
            foreach( $purchases as $purchase ) :
                Product::find($purchase->product_id)->decrement('stock', $purchase->count);
            endforeach;
        endif;
        return redirect("/transactions/$transaction->id")->with('message', '<div class="alert alert-success" role="alert">Transaksi <strong>' . $request->status . '</strong>.</div>');
    }

    public function autoCancel($id){
        $transaction = Transaction::find($id);
        $transaction->update([
            'status' => 'dibatalkan'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pesanan berhasil dibatalkan!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
