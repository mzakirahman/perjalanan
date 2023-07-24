<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perjalanan extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = true;
    protected $primaryKey = 'id_perjalanan';
    protected $table = 'tb_perjalanan';
    protected $fillable = [
        'id_perjalanan',
        'petugas',
        'penerima',
        'driver',
        'tanggal',
        'nopol',
        'jenis',
        'penumpang',
        'foto',
        'pos1',
        'pos9',
        'from'
    ];
}
