@extends('admin.layouts.app', ['title' => 'Bulan Tagihan'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-2">
            <div class="card-body">
              <h5 class="fw-medium text-green">Student</h5>
            </div>
        </div>

        {{-- Card Content --}}
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 px-3 mt-3">
                    <div class="card-body">
                        @error('duplicate')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <form action="{{ route('admin.month_bill.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-1">Name</label>
                                <select name="name" class="form-select">
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tahun</label>
                                <input type="text" name="year" class="form-control" placeholder="Tahun tagihan">
                                @error('year')
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
                                        <th>Nama Bulan</th>
                                        <th>Tahun</th>
                                        <th style="max-width: 100px">Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($monthBills as $monthBill)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $monthBill->name }}</td>
                                        <td>{{ $monthBill->year }}</td>
                                        <td style="max-width: 150px">{{ $monthBill->description }}</td>
                                        <td class="text-center d-flex">
                                            <a href="" class="btn btn-sm shadow-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.month_bill.destroy', $monthBill->id) }}" class="ms-1" method="post">
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
                            {{ $monthBills->links() }}
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection