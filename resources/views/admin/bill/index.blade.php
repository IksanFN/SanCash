@extends('admin.layouts.app', ['title' => 'Tagihan'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-3">
            <div class="card-body">
            <h5 class="fw-medium text-green">Tagihan</h5>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-sm shadow-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Buat Tagihan Per-kelas
        </button>

        @include('admin.partials.alert')

        <div class="row">
            @forelse ($bills as $bill)
            <div class="col-lg-4">
                <div class="card border-0 px-3 py-2 mb-3">
                    <div class="card-body">
                        <h5>{{ $bill->weekBill->name }}</h5>
                        <h6>{{ $bill->monthBill->name }} {{ $bill->year->name }}</h6>
                        <p>Total : Rp. {{ number_format($bill->bill) }}</p>
                        <a href="{{ route('admin.bill.list_bill', $bill->id) }}" class="btn btn-secondary btn-sm shadow-sm">Detail</a>
                        <a href="" class="btn btn-danger btn-sm shadow-sm">Hapus</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12">
                <div class="alert alert-secondary border-0 text-center">Data Tagihan belum ada, buat terlebih dahulu</div>
            </div>
            @endforelse
        </div>

        <!-- Button trigger modal -->
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tagihan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.bill.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas_id" class="form-control">
                                @foreach ($kelas as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tagihan untuk</label>
                            <select name="week_bill_id" class="form-control">
                                @foreach ($weeks as $week)
                                    <option value="{{ $week->id }}">{{ $week->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tagihan untuk bulan</label>
                            <select name="month_bill_id" class="form-control">
                                @foreach ($months as $month)
                                    <option value="{{ $month->id }}">{{ $month->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tagihan untuk tahun</label>
                            <select name="year_id" class="form-control">
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="start_of_week">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="end_of_week">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nilai Tagihan</label>
                            <input type="text" class="form-control" name="bill" placeholder="Cth: 10.000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm shadow-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm shadow-sm">Save</button>
                    </form>
                </div>
            </div>
            </div>
        </div>

    </div>
</section>
@endsection