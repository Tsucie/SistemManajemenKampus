<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kls_id',
        'kls_code',
        'kls_name',
        'kls_capacity',
        'kls_mhs_count',
        'kls_desc'
    ];
}
