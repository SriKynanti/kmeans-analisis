<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klusterisasi extends Model
{
    use HasFactory;

    protected $table = 'klusterisasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'dt_dataset',
        'dt_pembentukan_centroid',
        'dt_perhitungan_centroid',
        'dt_nilai_minimum_kelas',
        'dt_new_centroid',
        'tanggal_pembuatan',
    ];
}
