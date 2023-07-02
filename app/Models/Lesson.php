<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = "nilai";
    public $timestamps = false;

    protected $fillable = [
        'id_lesson',
        'nama',
        'pre_test',
        'post_test',
        'delay_test',
    ];
}
