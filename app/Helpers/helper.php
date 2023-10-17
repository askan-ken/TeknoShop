<?php
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

function rupiah($angka)
{
	$hasil_rupiah = "Rp." . number_format($angka,0,',','.');
	return $hasil_rupiah;
}

function generateTransactionToken()
{
    $brand = 'SRL';
    $date = date('dmY');
    $random = Str::upper(Str::random(4));
    $hour = date('His');
    $token = $brand . '-' . $date . '-' . $random . '-' . $hour;
    // while( count( Transaction::where('transaction_token', $token)->get() ) > 0 ){
    //     $token = Uuid::uuid1()->toString();
    // }
    return $token;
}