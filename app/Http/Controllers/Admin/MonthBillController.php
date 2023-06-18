<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MonthBill\Store;
use App\Http\Requests\Admin\MonthBill\Update;
use App\Models\MonthBill;
use Illuminate\Http\Request;

class MonthBillController extends Controller
{
    public function index()
    {
        $nomor = 1;
        // Get data 
        $monthBills = MonthBill::latest()->paginate(6);
        return view('admin.month-bill.index', compact('monthBills', 'nomor'));
    }

    public function store(Store $request)
    {
        // Insert to database
        $createMonthBill = MonthBill::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Check Condition
        if ($createMonthBill) {
            session()->flash('success', 'Data berhasil di simpan');
            return back();
        } else {
            session()->flash('error', 'Data berhasil di simpan');
            return back();
        }
    }

    public function edit(MonthBill $monthBill)
    {
        // Find data by ID
        $monthBill = MonthBill::find($monthBill->id);
        return view('admin.month-bill.edit', compact('monthBill'));
    }

    public function update(Update $request, MonthBill $monthBill)
    {
        // Find data by ID
        $monthBill = MonthBill::find($monthBill->id);
        $monthBill->update($request->all());

        // Check Condition
        if ($monthBill) {
            session()->flash('success', 'Data berhasil di update!');
            return redirect()->route('admin.month_bill.index');
        } else {
            session()->flash('error', 'Data berhasil di update!');
            return redirect()->route('admin.month_bill.index');
        }
    }

    public function destroy(MonthBill $monthBill)
    {
        // Find data by ID
        $monthBill = MonthBill::find($monthBill->id);

        // Check Condition
        if ($monthBill->delete()) {
            session()->flash('success', 'Data berhasil di hapus!');
            return back();
        } else {
            session()->flash('error', 'Data berhasil di hapus!');
            return back();
        }
    }
}
