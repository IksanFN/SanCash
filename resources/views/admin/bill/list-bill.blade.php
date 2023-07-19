@extends('admin.layouts.app', ['title' => 'Tagihan'])

@section('content')
<section class="">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-3">
            <div class="card-body">
                <h5 class="fw-medium text-green">Daftar Tagihan</h5>
                <p>{{ $name->weekBill->name }}, {{ $name->monthBill->name }} {{ $name->year->name }}</p>
            </div>
            </div>
        </div>
        
        <a href="{{ route('admin.bill.index') }}" class="btn btn-sm btn-secondary mb-3">Kembali</a>
        <a href="{{ route('admin.transaction.export', $name->id) }}" class="btn btn-sm btn-success mb-3">Export Excel</a>

        @include('admin.partials.alert')

        {{-- Data --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 py2 px-3">
                    <div class="card-body">
                        <h4></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tagihan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $nomor }}</td>
                                            <td>{{ $transaction->student->user->nisn }}</td>
                                            <td>{{ $transaction->student->user->name }}</td>
                                            <td>{{ $transaction->bill->kelas->name }}</td>
                                            <td>Rp. {{ number_format($transaction->bill->bill) }}</td>
                                            <td>
                                                @if ($transaction->payment_status == 'Belum Bayar')
                                                    <span class="badge bg-warning">Belum Bayar</span>
                                                @else
                                                    <span class="badge bg-success">Sudah Bayar</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($transaction->payment_status == 'Belum Bayar' && $transaction->status == 0)
                                                    <a href="{{ route('admin.transaction.checkout', $transaction->uuid) }}" class="btn btn-primary btn-sm">Checkout</a>
                                                @else
                                                    <a href="{{ route('admin.bill.invoice', $transaction->id) }}" class="btn btn-secondary btn-sm">Invoice</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-warning">Data tagihan tidak ada</div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection