@extends('admin.layouts.app', ['title' => 'Student'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-3">
            <div class="card-body">
              <h5 class="fw-medium text-green">Student</h5>
            </div>
        </div>

        {{-- Data --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 px-3 pt-2">
                    <div class="card-body">
                        @include('admin.partials.alert')
                        <div class="alert alert-secondary border-0 alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            Pastikan data <strong>User, Kelas, Jurusan</strong> sudah ada atau terinput!
                        </div>
                        <a href="{{ route('admin.student.create') }}" class="btn btn-primary shadow-sm mb-1">Mapping Student</a>
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Avatar</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td class="align-middle">{{ $nomor++ }}</td>
                                            <td class="align-middle"><img src="{{ asset('storage/avatar/'.$student->User->avatar) }}" alt="" width="50" height="50" class="rounded-circle"></td>
                                            <td class="align-middle">{{ $student->User->nisn }}</td>
                                            <td class="align-middle">{{ $student->User->name }}</td>
                                            <td class="align-middle">{{ $student->Kelas->name }}</td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('admin.student.show', $student->uuid) }}" class="btn btn-sm btn-secondary">Detail</a>
                                                <a href="{{ route('admin.student.edit', $student->uuid) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('admin.student.destroy', $student->uuid) }}" class="d-inline-flex" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm shadow-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-warning text-center">
                                            Data Student belum ada
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
