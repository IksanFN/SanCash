<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function monthBill()
    {
        return $this->belongsTo(MonthBill::class);
    }

    public function weekBill()
    {
        return $this->belongsTo(WeekBill::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
