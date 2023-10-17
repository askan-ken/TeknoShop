<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addCart(Product $product )
    {
        // dd($request);
        Cart::create([
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
        ]);
        return redirect("/products/$product->id")->with('message', '<div class="alert alert-success" role="alert">Data produk <strong>berhasil</strong> ditambah ke <a href="/cart">keranjang</a>.</div>');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.carts.index', [
            'title' => 'Keranjang Anda',
            'carts' => Cart::with('product')->where('user_id', auth()->user()->id)->where('is_buy', false)->available()->orderBy('id', 'DESC')->get(),
            'buys' => Cart::with('product')->where('user_id', auth()->user()->id)->where('is_buy', true)->unavailable()->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {
        $carts = Cart::with('product')->whereIn('id', $request->carts)->available()->orderBy('id', 'DESC')->get();
        return view('pages.carts.create', [
            'title' => 'Konfirmasi Pembelian',
            'carts' => $carts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartIds = $request->cartIds;
        $purchases = $request->purchases;

        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'price_total' => 0,
            'notes' => $request->notes,
        ]);

        // dd($transaction);
        
        $transactionId = $transaction->id;

        $priceTotal = 0;
        for ($i = 0; $i < count($purchases); $i++) {
            $product = Product::find($purchases[$i]['product_id']);
            if($product->stock <$purchases[$i]['count']){
                return redirect()->back()->with('errorCheckout','<div class="alert alert-danger" role="alert">
                Pembelian <strong>gagal</strong>. Jumlah pembelian melebihi stok.</div>');
            }
            $price = $purchases[$i]['product_price'] * $purchases[$i]['count'];
            $purchases[$i]['transaction_id'] = $transactionId;
            $purchases[$i]['price'] = $price;
            $purchases[$i]['created_at'] = Carbon::now()->toDateTimeString();
            $purchases[$i]['updated_at'] = Carbon::now()->toDateTimeString();
            unset($purchases[$i]['product_price']);
            $priceTotal += $price;
        }
        Transaction::find($transactionId)->update([
            'price_total' => $priceTotal,
            'batas_waktu' => Carbon::now()->addDay()
        ]);
        Purchase::insert($purchases);
        Cart::whereIn('id', $cartIds)->update([
            'is_buy' => true
        ]);
        return redirect("/transactions/$transactionId")->with('message', '<div class="alert alert-success" role="alert">Pembelian <strong>berhasil</strong>. Scroll paling bawah untuk melakukan pembayaran.</div>');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
