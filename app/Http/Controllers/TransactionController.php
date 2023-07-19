<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\Bill;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TransactionController extends Controller
{
    public function payment(Transaction $transaction)
    {
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

    public function createPDF(Transaction $transaction)
    {
        
        
        $data = [
            'studentName' => $transaction->student->user->name,
            'invoiceCode' => $transaction->invoice,
            'weekName' => $transaction->bill->weekBill->name,
            'monthName' => $transaction->bill->monthBill->name,
            'yearBill' => $transaction->bill->year->name,
            'bill' => $transaction->bill->bill,
            'className' => $transaction->student->kelas->name,
            'status' => $transaction->payment_status,
            'studentEmail' => $transaction->student->user->email,
            'date' => $transaction->payment_date,
            'studentJurusan' => $transaction->student->jurusan->name,
        ];

        
        $pdf = PDF::loadView('admin.bill.view-invoice', $data);
        return $pdf->download($transaction->invoice.'.pdf');

    }
    
    public function export($id)
    {
        // return $transaction;
        $data = Bill::whereId($id)->first();
        $nameMonth = $data->monthBill->name;
        $yearBill = $data->year->name;

        // return Excel::download(new TransactionsExport, 'invoices.xlsx');
        return (new TransactionsExport($id))->download($nameMonth.'-'.$yearBill.'.xlsx');
        // return Excel::download(new TransactionsExport($transaction->bill_id), $nameMonth.'-'.$yearBill.'.xlsx');
    }
}
