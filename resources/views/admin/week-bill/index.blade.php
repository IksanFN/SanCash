@extends('admin.layouts.app', ['title' => 'Weeks'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2">
            <div class="card-body">
              <h5 class="fw-medium text-green">Minggu</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 px-3 mt-3">
                    <div class="card-body">
                        <form action="{{ route('admin.week.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-1">Week</label>
                                <select name="name" class="form-select" required>
                                    <option value="Minggu ke 1">Minggu ke 1</option>
                                    <option value="Minggu ke 2">Minggu ke 2</option>
                                    <option value="Minggu ke 3">Minggu ke 3</option>
                                    <option value="Minggu ke 4">Minggu ke 4</option>
                                </select>
                                <div class="form-text text-danger">*Pilih salah satu</div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" placeholder="Deskripsi"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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
                                        <th>Week</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($weeks as $week)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $week->name }}</td>
                                        <td>{{ $week->description }}</td>
                                        <td class="text-center d-flex justify-content-center">
                                            <a href="{{ route('admin.week.edit', $week->id) }}" class="btn btn-sm shadow-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.week.destroy', $week->id) }}" class="ms-1" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm shadow-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <div class="alert alert-warning border-0">
                                            Data user belum ada
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $weeks->links() }}
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection