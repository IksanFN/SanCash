@extends('admin.layouts.app', ['title' => 'Student'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-3">
            <div class="card-body">
              <h5 class="fw-medium text-green">Student - {{ $student->User->name }}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 px-3 py-2">
                    <div class="card-body">
                        <img src="{{ asset('storage/avatar/'.$student->User->avatar) }}" alt="" class="img-fluid rounded">
                    </div>
                </div>
                <a href="{{ route('admin.student.index') }}" class="btn btn-secondary mt-3 shado">Kembali</a>
            </div>
            <div class="col-lg-8">
                <div class="card border-0 px-3 py-2">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center fw-medium h5">Data Student</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Unik ID</td>
                                        <td class="text-start">{{ $student->uuid }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Nama</td>
                                        <td>{{ $student->User->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NISN</td>
                                        <td>{{ $student->User->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Email</td>
                                        <td>{{ $student->User->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">No Handphone</td>
                                        <td>{{ $student->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Jenis Kelamin</td>
                                        <td>{{ $student->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Kelas</td>
                                        <td>{{ $student->Kelas->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Jurusan</td>
                                        <td>{{ $student->Jurusan->name }} - {{ $student->Jurusan->jurusan_code }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Alamat</td>
                                        <td>{{ $student->alamat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
@endsection