@extends('admin.layouts.app', ['title' => 'Users'])

@section('content')
<section class="row justify-content-center">
    <div class="col-lg-12">

        {{-- Header --}}
        <div class="card border-0 px-3 pt-2">
            <div class="card-body">
              <h5 class="fw-medium text-green">User</h5>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card border-0 px-3 mt-3">
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $user->id }}">
                            <div class="mb-3">
                                <label class="mb-1">Nama </label>
                                <input type="text" class="form-control" name="name" placeholder="Nama User" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">NISN</label>
                                <input type="text" class="form-control" name="nisn" placeholder="cth: 192010213" value="{{ old('nisn', $user->nisn) }}">
                                @error('nisn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="example@gmail.com" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Avatar</label>
                                <input type="file" class="form-control" name="avatar">
                                @error('avatar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Role (pilih role)</label>
                                <select name="role" class="form-control" aria-placeholder="Pilih role">
                                    <option value="admin" {{ $user->role == "admin" ? "selected" : ""}}>Admin</option>
                                    <option value="student" {{ $user->role == "student" ? "selected" : ""}}>Student</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" value="{{ $user->password }}" @disabled(true)>
                            </div>
                            @error('error')
                                <div class="my-2">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="row mx-0 mb-2">
                                <button type="submit" class="btn btn-secondary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection