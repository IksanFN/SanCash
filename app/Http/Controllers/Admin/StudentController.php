<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\Store;
use App\Http\Requests\Admin\Student\Update;

class StudentController extends Controller
{
    public function index()
    {
        $nomor = 1;
        // Get data Student with User & Kelas
        $students = Student::with(['User', 'Kelas'])->latest()->paginate(15);
        return view('admin.student.index', compact('students', 'nomor'));
    }

    public function show($uuid)
    {
        // Get data by Uuid
        $student = Student::with(['User', 'Kelas', 'Jurusan'])->whereUuid($uuid)->first();
        return view('admin.student.show', compact('student'));
    }

    public function create()
    {
        // Get data User, Kelas & Jurusan
        $users = User::select('id', 'name')->whereNot('role', 'admin')->get();
        $allKelas = Kelas::select('id', 'name')->get();
        $jurusans = Jurusan::select('id', 'name', 'jurusan_code')->get();
        return view('admin.student.create', compact('users', 'allKelas', 'jurusans'));
    }

    public function edit($uuid)
    {
        // Get data Kelas, User, & Jurusan
        $allKelas = Kelas::select('id', 'name')->get();
        $users = User::select('id', 'name')->whereNot('role', 'admin')->get();
        $jurusans = Jurusan::select('id', 'name', 'jurusan_code')->get();

        // Get data by Uuid
        $student = Student::with(['User', 'Kelas', 'Jurusan'])->whereUuid($uuid)->first();
        return view('admin.student.edit', compact('student', 'allKelas', 'jurusans', 'users'));
    }

    public function update(Update $request, $uuid)
    {
        // Update data by ID
        $student = Student::whereUuid($uuid)->first();

        // Assigne request to $data
        $data = [
            'user_id' => $request->user_id,
            'jurusan_id' => $request->jurusan_id,
            'kelas_id' => $request->kelas_id,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ];

        // Check Condition
        if ($student->update($data)) {
            session()->flash('success', 'Data berhasil di update');
            return redirect()->route('admin.student.index');
        } else {
            session()->flash('error', 'Data gagal di update');
            return redirect()->route('admin.student.index');
        }
    }

    public function store(Store $request)
    {
        // Hidden token
        $request->except('_token');

        // Insert to database
        $student = Student::create([
            'uuid' => Str::uuid(10),
            'user_id' => $request->user_id,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        // Check Condition
        if ($student) {
            session()->flash('success', 'Data berhasil di simpan');
        } else {
            session()->flash('error', 'Data gagal di simpan');
        }

        // redirect
        return redirect()->route('admin.student.index');
    }

    public function destroy($uuid)
    {
        $student = Student::whereUuid($uuid)->first();
        if ($student->delete()) {
            session()->flash('success', 'Data berhasil di hapus');
            return redirect()->route('admin.student.index');
        } else {
            session()->flash('error', 'Data gagal di hapus');
            return redirect()->route('admin.student.index');
        }
    }
}
