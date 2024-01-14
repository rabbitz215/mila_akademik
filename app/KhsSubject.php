<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhsSubject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function khs()
    {
        return $this->belongsTo(Khs::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getNilaiAttribute()
    {
        return Khs::GRADES[$this->grade];
    }
}
