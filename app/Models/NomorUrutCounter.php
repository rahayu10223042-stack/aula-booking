<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NomorUrutCounter extends Model
{
    protected $fillable = ['kode_klasifikasi', 'tahun', 'last_number'];
}
