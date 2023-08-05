<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public $idBill;

    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
            'Jurusan',
            'Kelas',
            'Tagihan',
            'Status',
            'Tanggal Bayar',
        ];
    }

    public function __construct($idBill)
    {
        $this->idBill = $idBill;
    }

    public function query()
    {
        return Transaction::query()->whereBillId($this->idBill);
    }

    public function map($transactions): array
    {
        return [
            $transactions->student_nisn,
            $transactions->student_name,
            $transactions->student_jurusan,
            $transactions->student_kelas,
            $transactions->bill,
            $transactions->payment_status,
            $transactions->payment_date
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
