<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Kelas\Store;
use Alert;

class KelasController extends Controller
{
    public function index()
    {
        // Get data 
        $listKelas = Kelas::latest()->paginate(5);
        $nomor = 1;
        return view('admin.kelas.index', compact('listKelas', 'nomor'));
    }

    public function store(Store $request)
    {
        // Save request to variabel data
        $data = $request->only('name', 'description');

        // Insert to database
        $kelas = Kelas::create($data);

        // Condition
        if ($kelas) {
            // Flash Message
            session()->flash('success', 'Data berhasil di tambahkan');
            return back();
        } else {
            return back()->withErrors(['error' => 'Terjadi kesalahan'])->withInput();
        }
    }

    public function edit(Kelas $kelas)
    {
        // Get data by Id
        $oneKelas = Kelas::whereId($kelas->id)->first();
        return view('admin.kelas.edit', compact('oneKelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        // Hidden Token
        $data = $request->except('_token');

        // Update to database
        $kelas->update($data);

        // Flash Message
        session()->flash('success', 'Data berhasil di update');

        return redirect()->route('admin.kelas.index');
    }

    public function destroy(Kelas $kelas)
    {
        // Delete in database
        $kelas->delete();

        // Flash Message
        session()->flash('success', 'Data berhasil di hapus');
        return redirect()->route('admin.kelas.index');
    }
}
