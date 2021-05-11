<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sal_id',
        'sal_stf_id',
        'sal_s_id',
        'sal_code',
        'sal_value',
        'sal_date',
        'sal_channel',
        'sal_desc'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'sal_rec_status',
        'sal_rec_createdby',
        'sal_rec_created',
        'sal_rec_updatedby',
        'sal_rec_updated',
        'sal_rec_deletedby',
        'sal_rec_deleted'
    ];
}
