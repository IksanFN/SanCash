<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Jurusan\Store;
use App\Http\Requests\Admin\Jurusan\Update;

class JurusanController extends Controller
{
    public function index()
    {
        $listJurusan = Jurusan::latest()->paginate(5);
        $nomor = 1;
        return view('admin.jurusan.index', compact('listJurusan', 'nomor'));
    }

    public function edit(Jurusan $jurusan)
    {
        $oneJurusan = Jurusan::whereId($jurusan->id)->first();
        return view('admin.jurusan.edit', compact('oneJurusan'));
    }

    public function store(Store $request)
    {
        // Save request to variabel
        $data = $request->except('_token');
        
        // Insert database
        if ($jurusan = Jurusan::create($data)) {
            session()->flash('success', 'Data berhasil di tambahkan');
            return back();
        } else {
            return back()->withErrors(['error', 'Data gagal di simpan, silahkan coba lagi'])->withInput();
        }

    }

    public function update(Update $request, Jurusan $jurusan)
    {
        // Hidden token
        $data = $request->except('_token');

        // Save to database
        $jurusan->update($data);

        // Flash message
        session()->flash('success', 'Data berhasil di update');

        return redirect()->route('admin.jurusan.index');
    }

    public function destroy(Jurusan $jurusan)
    {
        // Delete data
        $jurusan->delete();

        // Flash message
        session()->flash('success', 'Data berhasil di hapus');

        return back();
    }
}
