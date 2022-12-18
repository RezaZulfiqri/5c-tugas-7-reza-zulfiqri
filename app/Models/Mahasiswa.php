<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function ukms(){
        return $this->belongsToMany(Ukm::class, 'ukm_unsika', 'mahasiswa_id'
        ,'ukm_id')->withTimestamps();
    }
}
