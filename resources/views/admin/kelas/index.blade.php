@extends('admin.layouts.app', ['title' => 'Kelas'])

@section('content')
  <div class="row">
      <div class="col-lg-12">

          {{-- Heading --}}
          <div class="card border-0 px-3 pt-2">
              <div class="card-body">
                <h5 class="fw-medium text-green">Kelas</h5>
              </div>
          </div>

          {{-- Card Content --}}
          <div class="row">
              <div class="col-lg-4">
                  <div class="card border-0 px-3 mt-3">
                      <div class="card-body">
                          <form action="{{ route('admin.kelas.store') }}" method="post">
                              @csrf
                              <div class="mb-3">
                                  <label class="mb-1">Name</label>
                                  <input type="text" class="form-control" name="name" placeholder="Class Name" value="{{ old('name') }}">
                                  @error('name')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                              <div class="mb-4">
                                  <label class="mb-1">Description</label>
                                  <textarea class="form-control" name="description" placeholder="Description class">{{ old('description') }}</textarea>
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
              <div class="col-lg-8">
                  <div class="card mt-3 border-0 px-3 pt-2">
                      @include('admin.partials.alert')
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table" id="kelasTable">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Name Class</th>
                                          <th style="max-width: 100px">Description</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse ($listKelas as $kelas)
                                      <tr>
                                          <td>{{ $nomor++ }}</td>
                                          <td>{{ $kelas->name }}</td>
                                          <td style="max-width: 150px">{{ $kelas->description }}</td>
                                          <td class="text-center d-flex">
                                              <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="btn btn-sm shadow-sm btn-primary">Edit</a>
                                              <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" class="ms-1" method="post">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-sm shadow-sm btn-danger">Delete</button>
                                              </form>
                                          </td>
                                      </tr>
                                      @empty
                                          <div class="alert alert-danger">
                                              Data kelas belum ada
                                          </div>
                                      @endforelse
                                  </tbody>
                              </table>
                              {{ $listKelas->links() }}
                          </div>
      
                      </div>
                  </div>
              </div>
          </div>
          
      </div>
  </div>
  @endsection