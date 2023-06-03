@extends('admin.layouts.app', ['title' => 'Jurusan'])

@section('content')
<div class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2">
            <div class="card-body">
              <h5 class="fw-medium text-green">Edit Jurusan</h5>
            </div>
        </div>

        {{-- Card Content --}}
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card border-0 px-3 mt-3">
                    <div class="card-body">
                        <form action="{{ route('admin.jurusan.update', $oneJurusan->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $oneJurusan->id }}">
                            <div class="mb-3">
                                <label class="mb-1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Class Name" value="{{ old('name', $oneJurusan->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Jurusan Kode</label>
                                <input type="text" class="form-control" name="jurusan_code" placeholder="Kode Jurusan" value="{{ old('jurusan_code', $oneJurusan->jurusan_code) }}">
                                @error('jurusan_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="mb-1">Description</label>
                                <textarea class="form-control" name="description" placeholder="Description class">{{ old('description', $oneJurusan->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
        </div>
        
    </div>
</div>
@endsection