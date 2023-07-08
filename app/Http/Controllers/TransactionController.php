<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function payment(Transaction $transaction)
    {
        // return $transaction;
        // Update transaction
        $transaction->update([
            'payment_status' => 'Sudah Bayar',
            'is_paid' => 1,
            'payment_date' => now(),
            'payment_method' => 'Manual',
        ]);

        // Check Condition
        if ($transaction) {
            session()->flash('success', 'Transaksi berhasil');
            return redirect()->route('admin.bill.list_bill', $transaction->bill_id);
        } else {
            session()->flash('error', 'Transaksi gagal');
            return redirect()->route('admin.bill.list_bill', $transaction->bill_id);
        }
    }
}
