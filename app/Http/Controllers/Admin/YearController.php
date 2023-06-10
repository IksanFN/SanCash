<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Year\Store;
use App\Http\Requests\Admin\Year\Update;
use App\Models\Year;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class YearController extends Controller
{
    public function index()
    {
        $nomor = 1;
        $years = Year::latest()->paginate(6);
        return view('admin.year.index', compact('years', 'nomor'));
    }

    public function store(Store $request)
    {
        // Save to variable data and hidden token
        $data = $request->except('_token');

        // Insert to database
        $years = Year::create($data);

        // Check condition
        if ($years) {
            session()->flash('success', 'Data berhasil di simpan!');
            return back();
        } else {
            session()->flash('error', 'Data gagal di simpan!');
            return back();
        }
    }

    public function edit(Year $year)
    {
        $year = Year::whereId($year->id)->first();
        return view('admin.year.edit', compact('year'));
    }

    public function update(Update $request, Year $year)
    {
        $year = Year::whereId($year->id)->first();
        $year->update($request->all());

        if ($year) {
            session()->flash('success', 'Data berhasil di update!');
            return redirect()->route('admin.year.index');
        } else {
            session()->flash('success', 'Data gagal di update!');
            return redirect()->route('admin.year.index');
        }
    }

    public function destroy(Year $year)
    {
        $year = Year::whereId($year->id)->first();
        if ($year->delete()) {
            session()->flash('success', 'Data berhasil di hapus!');
            return back();
        } else {
            session()->flash('success', 'Data gagal di hapus!');
            return back();
        }
    }
}
