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
                <a href="{{ route('admin.transaction.download_invoice', $invoice->id) }}" class="btn btn-primary btn-sm shadow-sm mb-3">Export PDF</a>
                <div class="card border-0 px-3 pt-3 pb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><strong>{{ $invoice->invoice }}</strong></h4>
                                <p class="mb-0">Tagihan : <strong>{{ $invoice->week_name }}, {{ $invoice->month_name }} {{ $invoice->year_name }}</strong></p>
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
                                <p class="fw-bold mb-0">{{ $invoice->student_name }}</p>
                                <p>{{ $invoice->student_kelas}}</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Nama</th>
                                        <th style="text-align: right;">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nama Siswa</td>
                                        <td style="text-align: right;">{{ $invoice->student_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td style="text-align: right;">{{ $invoice->student_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td style="text-align: right;">{{ $invoice->payment_status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Bayar</td>
                                        <td style="text-align: right;">{{ $invoice->payment_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tagihan</td>
                                        <td style="text-align: right;">IDR {{ number_format($invoice->bill) }}</td>
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