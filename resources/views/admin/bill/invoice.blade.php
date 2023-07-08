@extends('admin.layouts.app', ['title' => 'Invoice'])

@section('content')
<section class="row">
    <div class="col-lg-12">

        {{-- Heading --}}
        <div class="card border-0 px-3 pt-2 mb-3">
            <div class="card-body">
            <h5 class="fw-medium text-green">Invoice</h5>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <a href="{{ route('admin.bill.list_bill', $invoice->bill_id) }}" class="btn btn-secondary btn-sm shadow-sm mb-3">Kembali</a>
                <a href="" class="btn btn-primary btn-sm shadow-sm mb-3">Export PDF</a>
                <div class="card border-0 px-3 pt-3 pb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><strong>{{ $invoice->invoice }}</strong></h4>
                                <p class="mb-0">Tagihan : <strong>{{ $invoice->bill->weekBill->name }}, {{ $invoice->bill->monthBill->name }} {{ $invoice->bill->year->name }}</strong></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-0">Bill From:</p>
                                <p class="fw-bold">SMK Taruna Harapan 1 Cipatat</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <p class="mb-0">Bill To:</p>
                                <p class="fw-bold mb-0">{{ $invoice->student->user->name }}</p>
                                <p>{{ $invoice->student->kelas->name }}</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tagihan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Iksan Fauzi</td>
                                        <td>XII RPL 1</td>
                                        <td>10.000</td>
                                        <td>Paid</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <p class="text-center mb-0">Terima kasih atas partisipasinya terhadap kelas dan lingkungan sekolah.</p>
                        <p class="text-center">SanCash.</p>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection