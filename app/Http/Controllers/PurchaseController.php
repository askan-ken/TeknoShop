<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.purchases.index', [
            'title' => 'Data Penjualan',
            'transactions' => Transaction::with('purchases.product', 'user')->date(request('date'))->status(request('status'))->orderBy('id', 'DESC')->get()
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
    public function show($transactionId)
    {
        $transaction = Transaction::with('purchases.product', 'user')->firstWhere('id', $transactionId);
        return view('dashboard.pages.purchases.show', [
            'title' => 'Detail Penjualan',
            'transaction' => $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($transactionId)
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
    public function update(Request $request, $transactionId)
    {
        $validated = $request->validate([
            'status' => 'required|in:dikirim,ditolak',
        ]);
        if( $validated['status'] == 'dikirim' ) :
            $transaction = Transaction::with('purchases.product', 'user')->firstWhere('id', $transactionId);
            $purchases = $transaction->purchases;
            foreach ($purchases as $purchase) :
                Product::find($purchase->product_id)->decrement('stock', $purchase->count);
            endforeach;
        endif;
        Transaction::find($transactionId)->update($validated);
        return redirect("/dashboard/purchases/$transactionId")->with('message', '<div class="alert alert-success" role="alert">Pembelian <strong>' . $request->status . '</strong>.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($transactionId)
    {
        //
    }
}
