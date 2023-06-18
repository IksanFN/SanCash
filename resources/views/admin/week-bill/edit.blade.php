@extends('admin.layouts.app', ['title' => 'Weeks'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2">
            <div class="card-body">
              <h5 class="fw-medium text-green">Edit Week</h5>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card border-0 px-3 mt-3">
                    <div class="card-body">
                        <form action="{{ route('admin.week.update', $week->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" value="{{ $week->id }}">
                                <label class="mb-1">Tahun</label>
                                <select name="name" class="form-select">
                                    @foreach ($allWeek as $allWeek)
                                        <option value="{{ $allWeek->name }}" {{ ($allWeek->name == $week->name) ? 'selected' : '' }}>{{ $allWeek->name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" placeholder="Deskripsi">{{ $week->description }}</textarea>
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
        </div>

    </div>
</section>
@endsection