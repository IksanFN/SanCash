@extends('admin.layouts.app', ['title' => 'Student'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-3">
            <div class="card-body">
              <h5 class="fw-medium text-green">Edit Student</h5>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 px-3 pt-2">
                    <div class="card-body">
                        <form action="{{ route('admin.student.update', $student->uuid) }}" method="post">
                            @csrf
                            @method('PUT')
                           <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <input type="hidden" value="{{ $student->id }}">
                                    <div class="mb-3">
                                        <label class="form-label">Student</label>
                                        <select name="user_id" class="form-select">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ ($student->user_id == $user->id) ?'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <span class="text-danger">
                                                Student tersebut sudah terdaftar
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <select name="kelas_id" class="form-select" id="single-select-field" data-placeholder="Pilih Kelas">
                                            @foreach ($allKelas as $kelas)
                                                <option value="{{ $kelas->id }}" {{ ($student->kelas_id == $kelas->id) ? 'selected' : '' }}>{{ $kelas->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <span class="text-danger">Test</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jurusan</label>
                                        <select name="jurusan_id" class="form-select">
                                            @foreach ($jurusans as $jurusan)
                                                <option value="{{ $jurusan->id }}" {{ ($jurusan->id == $student->jurusan_id) ? 'selected' : '' }}>{{ $jurusan->name }} - {{ $jurusan->jurusan_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" {{ ($student->gender == 'Male') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" {{ ($student->gender == 'Female') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Handphone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="08xxxx" value="{{ $student->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" class="form-control" placeholder="Jl. Merdeka..">{{ $student->alamat }}</textarea>
                                    </div>
                                </div>
                                <div class="row mx-0 mb-3">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection