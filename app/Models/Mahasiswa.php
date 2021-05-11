<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mhs_id',
        'mhs_u_id',
        'mhs_fks_id',
        'mhs_ps_id',
        'mhs_kls_id',
        'mhs_fullname',
        'mhs_first_registered', // sm_code dimana mahasiswa pertama kali daftar
        'mhs_nim',
        'mhs_education',
        'mhs_address',
        'mhs_province',
        'mhs_city',
        'mhs_birthplace',
        'mhs_birthdate',
        'mhs_gender',
        'mhs_state',
        'mhs_email',
        'mhs_status',
        'mhs_contact',
        'mhs_ktp',
        'mhs_job'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'mhs_rec_status',
        'mhs_rec_createdby',
        'mhs_rec_created',
        'mhs_rec_updatedby',
        'mhs_rec_updated',
        'mhs_rec_deletedby',
        'mhs_rec_deleted'
    ];
}
