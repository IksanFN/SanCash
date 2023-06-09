@extends('admin.layouts.app', ['title' => 'Bulan Tagihan'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-3">
            <div class="card-body">
              <h5 class="fw-medium text-green">Student</h5>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 px-3 py-2">
                    <div class="card-body">
                        <form action="{{ route('admin.month_bill.update', $monthBill->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <select name="name" class="form-select">
                                    <option value="Januari" {{ ($monthBill->name == 'Januari') ? 'selected' : '' }}>Januari</option>
                                    <option value="Februari" {{ ($monthBill->name == 'Februari') ? 'selected' : '' }}>Februari</option>
                                    <option value="Maret" {{ ($monthBill->name == 'Maret') ? 'selected' : '' }}>Maret</option>
                                    <option value="April" {{ ($monthBill->name == 'April') ? 'selected' : '' }}>April</option>
                                    <option value="Mei" {{ ($monthBill->name == 'Mei') ? 'selected' : '' }}>Mei</option>
                                    <option value="Juni" {{ ($monthBill->name == 'Juni') ? 'selected' : '' }}>Juni</option>
                                    <option value="July" {{ ($monthBill->name == 'July') ? 'selected' : '' }}>July</option>
                                    <option value="Agustus" {{ ($monthBill->name == 'Agustus') ? 'selected' : '' }}>Agustus</option>
                                    <option value="September" {{ ($monthBill->name == 'September') ? 'selected' : '' }}>September</option>
                                    <option value="Oktober" {{ ($monthBill->name == 'Oktober') ? 'selected' : '' }}>Oktober</option>
                                    <option value="November" {{ ($monthBill->name == 'November') ? 'selected' : '' }}>November</option>
                                    <option value="Desember" {{ ($monthBill->name == 'Desember') ? 'selected' : '' }}>Desember</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control">{{ $monthBill->description }}</textarea>
                            </div>
                            <div class="row mx-0">
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