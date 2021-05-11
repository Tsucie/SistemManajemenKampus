<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mk_id',
        'mk_ps_id',
        'mk_sm_id',
        'mk_sks',
        'mk_mutu',
        'mk_code',
        'mk_name',
        'mk_semester',
        'mk_desc'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'mk_rec_status',
        'mk_rec_createdby',
        'mk_rec_created',
        'mk_rec_updatedby',
        'mk_rec_updated',
        'mk_rec_deletedby',
        'mk_rec_deleted'
    ];
}
