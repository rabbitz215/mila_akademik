<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TINGKAT_1 = 1;
    const TINGKAT_2 = 2;
    const TINGKAT_3 = 3;
    const TINGKAT_4 = 4;

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_kelas');
    }
}
