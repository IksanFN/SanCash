<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
