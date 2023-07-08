@extends('admin.layouts.app', ['title' => 'Checkout Tagihan'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-3">
            <div class="card-body">
                <h5 class="fw-medium text-green">Checkout Tagihan</h5>
            </div>
            </div>
        </div>

        <div class="">
            <a href="{{ route('admin.bill.list_bill', $checkout->bill_id) }}" class="btn btn-sm btn-secondary mb-3">Kembali</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 px-3 py-2">
                    <div class="card-body">
                        <form action="{{ route('admin.transaction.payment', $checkout->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" value="{{ $checkout->student->user->name }}" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label>NISN</label>
                                        <input type="text" class="form-control" value="{{ $checkout->student->user->nisn }}" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label>Kelas</label>
                                        <input type="text" class="form-control" value="{{ $checkout->bill->kelas->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label>Gender</label>
                                        <input type="text" class="form-control" value="{{ ($checkout->student->gender == 'Male') ? 'Laki-laki' : 'Perempuan' }}" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label>Jurusan</label>
                                        <input type="text" class="form-control" value="{{ $checkout->student->jurusan->name }}" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" value="{{ $checkout->student->alamat }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-2 text-center mt-2">
                                    <input type="text" class="form-control text-center" value="{{ 'Tagihan bulan '.$checkout->bill->monthBill->name.' '.$checkout->bill->weekBill->name.' sebesar Rp. '.number_format($checkout->bill->bill) }}">
                                </div>
                                <div class="mt-2 text-center">
                                    <button type="submit" class="btn btn-secondary shadow-sm">Checkout Tagihan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection