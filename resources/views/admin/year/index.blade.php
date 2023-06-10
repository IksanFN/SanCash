@extends('admin.layouts.app', ['title' => 'Year'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2">
            <div class="card-body">
              <h5 class="fw-medium text-green">Tahun</h5>
            </div>
        </div>

        {{-- Card Content --}}
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 px-3 mt-3">
                    <div class="card-body">
                        <form action="{{ route('admin.year.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-1">Tahun</label>
                                <input type="text" class="form-control" name="name" placeholder="Tahun" value="{{ old('name') }}">
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
                                        <th>Tahun</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($years as $year)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $year->name }}</td>
                                        <td>{{ $year->description }}</td>
                                        <td class="text-center d-flex justify-content-center">
                                            <a href="{{ route('admin.year.edit', $year->id) }}" class="btn btn-sm shadow-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.year.destroy', $year->id) }}" class="ms-1" method="post">
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
                            {{ $years->links() }}
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection