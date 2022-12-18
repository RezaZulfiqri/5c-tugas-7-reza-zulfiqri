<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ukm extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function mahasiswas(){
        return $this->belongsToMany(Mahasiswa::class, 'ukm_unsika', 'ukm_id'
        ,'mahasiswa_id')->withTimestamps();
    }
}
