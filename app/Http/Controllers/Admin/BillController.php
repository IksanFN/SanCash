<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\WeekBill;
use App\Models\MonthBill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Bill\Store;
use App\Models\Transaction;
use App\Models\Year;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class BillController extends Controller
{
    public function index()
    {
        // Get Data
        $years = Year::select('id', 'name')->get();
        $kelas = Kelas::select('id', 'name')->get();
        $weeks = WeekBill::select('id', 'name')->get();
        $months = MonthBill::select('id', 'name')->get();
        $bills = Bill::with(['student', 'monthBill', 'weekBill'])->get();

        return view('admin.bill.index', compact('bills', 'kelas', 'weeks', 'months', 'years'));
    }

    public function listBill(Bill $bill)
    {
        // Number list
        $nomor = 1;

        // Get data with more condition
        $kelas = Kelas::find($bill->kelas_id);
        
        // Data list transaction
        $transactions = Transaction::with(['bill', 'student', 'user'])
                    ->whereBillId($bill->id)
                    // ->where('end_of_week', '<=', )
                    ->get();
        // return $transactions;
        // Data name bill
        $name = Bill::with('weekBill', 'monthBill', 'year')
                    ->whereWeekBillId($bill->week_bill_id)
                    ->whereMonthBillId($bill->month_bill_id)
                    ->whereYearId($bill->year_id)
                    ->first();

        return view('admin.bill.list-bill', compact('nomor', 'name', 'transactions'));
    }

    public function checkout($uuid)
    {
        $checkout = Transaction::with(['bill', 'student', 'user'])->whereUuid($uuid)->first();
        return view('admin.bill.checkout', compact('checkout'));
    }

    public function storeByClass(Store $request)
    {
        // Hidden token
        $request->except('_token');

        $month = MonthBill::find($request->month_bill_id);
        $week = WeekBill::find($request->month_bill_id);
        $year = Year::find($request->month_bill_id);
        $class = Kelas::find($request->kelas_id);

        // Get all student by Class
        $students = Student::whereKelasId($request->kelas_id)->get();

        // Looping then insert data by ID Student
        foreach ($students as $student) {

            // Create Object
            $bill = new Bill();
            
            // Insert to database
            $bill->uuid = Str::uuid();
            $bill->kelas_id = $request->kelas_id;
            $bill->month_bill_id = $request->month_bill_id;
            $bill->week_bill_id = $request->week_bill_id;
            $bill->year_id = $request->year_id;
            $bill->kelas_name = $class->name;
            $bill->month_name = $month->name;
            $bill->week_name = $week->name;
            $bill->year_name = $year->name;
            $bill->start_of_week = $request->start_of_week;
            $bill->end_of_week = $request->end_of_week;
            $bill->bill = $request->bill;
            $bill->description = $request->description;
            $bill->save();

            // Get last insert id bill
            $idBill = $bill->id;
            
            // Check Condition
            if ($bill) {

                // Looping ID, then Insert to Table Transaction
                foreach ($students as $student) {   

                    // Generate Invoice Code
                    $lastInvoice = Transaction::orderBy('id', 'desc')->first();
                    if ($lastInvoice) {
                        $lastCode = $lastInvoice->invoice;
                        $numericPart = intval(substr($lastCode, -3)) + 1;
                        $newCode = 'INV/'.Str::upper($bill->monthBill->name).'/'.str_pad($numericPart, 3, '0', STR_PAD_LEFT);
                    } else {
                        $newCode = "INV/".Str::upper($bill->monthBill->name).'/001';
                    }

                    // Insert to database
                    $createTransaction = new Transaction();
                    $createTransaction->uuid = Str::uuid();
                    $createTransaction->student_id = $student->id;
                    $createTransaction->student_nisn = $student->student_nisn;
                    $createTransaction->student_name = $student->student_name;
                    $createTransaction->student_kelas = $student->student_class;
                    $createTransaction->student_jurusan = $student->student_jurusan;
                    $createTransaction->bill_id = $idBill;
                    $createTransaction->bill_name = $bill->week_name.', '.$bill->month_name.' '.$bill->year_name;
                    $createTransaction->bill_year = $bill->year_name;
                    $createTransaction->bill_month = $bill->month_name;
                    $createTransaction->bill_week = $bill->week_name;
                    $createTransaction->bill = $bill->bill;
                    $createTransaction->payment_status = 'Belum Bayar';
                    $createTransaction->invoice = $newCode;
                    $createTransaction->save();
                }

                session()->flash('success', 'Data Tagihan berhasil di buat!');
                return back();
            } else {
                session()->flash('success', 'Data Tagihan gagal di buat!');
                return back();
            }

        }

    }

    public function edit($uuid)
    {
        // Get data by uuid
        $bill = Bill::whereUuid($uuid)->first();
        return view('admin.bill.edit', compact('bill'));
    }

    // Show Invoice
    public function invoice(Transaction $transaction)
    {
        $invoice = $transaction;
        return view('admin.bill.invoice', compact('invoice'));
    }
}
