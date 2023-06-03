@extends('admin.layouts.app', ['title' => 'User'])

@section('content')
    <div class="row">
        <div class="col-lg-12">
    
            {{-- Heading --}}
            <div class="card border-0 px-3 pt-2">
                <div class="card-body">
                  <h5 class="fw-medium text-green">User</h5>
                </div>
            </div>
    
            {{-- Card Content --}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="alert alert-secondary my-3 pb-1 border-0">
                        <ul>
                            <li><small>Untuk user dengan role siswa berikan password default : 123456</small></li>
                            <li><small>Untuk user dengan role admin NISN boleh di kosongkan</small></li>
                        </ul>
                    </div>
                    <div class="card border-0 px-3 mt-3">
                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="mb-1">Nama </label>
                                    <input type="text" class="form-control" name="name" placeholder="Nama User" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">NISN</label>
                                    <input type="text" class="form-control" name="nisn" placeholder="cth: 192010213" value="{{ old('nisn') }}">
                                    @error('nisn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
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
                                        <option value="admin">Admin</option>
                                        <option value="student" selected>Student</option>
                                    </select>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                @error('Gagal')
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
                <div class="col-lg-8">
                    <div class="card mt-3 border-0 px-3 pt-2">
                        @include('admin.partials.alert')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="kelasTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Avatar</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            {{-- <th style="max-width: 100px">Description</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $nomor++ }}</td>
                                            <td><img src="{{ asset('storage/avatar/'.$user->avatar) }}" alt="" width="50" height="50" class="rounded-circle"></td>
                                            <td>
                                                @if ($user->nisn != NULL)
                                                <span class="badge bg-primary">{{ $user->nisn }}</span>
                                                @else
                                                <span class="badge bg-secondary">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td class="text-center d-flex">
                                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm shadow-sm btn-primary">Edit</a>
                                                <form action="{{ route('admin.user.destroy', $user->id) }}" class="ms-1" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm shadow-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data user belum ada
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $users->links() }}
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection