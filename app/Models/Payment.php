<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'py_id',
        'py_mhs_id',
        'py_code',
        'py_name',
        'py_value',
        'py_status',
        'py_paydate',
        'py_paychannel',
        'py_desc'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'py_rec_status',
        'py_rec_createdby',
        'py_rec_created',
        'py_rec_updatedby',
        'py_rec_updated',
        'py_rec_deletedby',
        'py_rec_deleted'
    ];
}
