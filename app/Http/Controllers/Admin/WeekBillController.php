<?php

namespace App\Http\Controllers\Admin;

use App\Models\WeekBill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WeekBill\Store;
use App\Http\Requests\Admin\WeekBill\Update;

class WeekBillController extends Controller
{
    public function index()
    {
        // Number list
        $nomor = 1;
        // Get data week
        $weeks = WeekBill::latest()->paginate(5);
        return view('admin.week-bill.index', compact('weeks', 'nomor'));
    }

    public function store(Store $request)
    {
        // Get request & hidden token
        $data = $request->except('_token');

        // Insert to database
        $week = WeekBill::create($data);

        // Check Condition
        if ($week) {
            session()->flash('success', 'Data berhasil di simpan!');
            return back();
        } else {
            session()->flash('error', 'Data gagal di simpan!');
            return back();
        }
    }

    public function edit(WeekBill $week)
    {
        // Find data by ID
        $week = WeekBill::find($week->id);
        // Get exist data
        $allWeek = WeekBill::select('id', 'name')->get();
        return view('admin.week-bill.edit', compact('week', 'allWeek'));
    }

    public function update(Update $request, WeekBill $week)
    {
        // Get request & hidden token
        $data = $request->except('_token');

        // Update to database
        $week->update($data);

        // Check condition
        if ($week) {
            session()->flash('success', 'Data berhasil di update!');
            return redirect()->route('admin.week.index');
        } else {
            session()->flash('error', 'Data gagal di update!');
            return redirect()->route('admin.week.index');
        }
    }

    public function destroy(WeekBill $week)
    {
        // Check Condition
        if ($week->delete()) {
            session()->flash('success', 'Data berhasil di hapus!');
            return back();
        } else {
            session()->flash('error', 'Data gagal di hapus!');
            return back();
        }
    }
}
