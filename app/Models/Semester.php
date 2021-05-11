<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sm_id',
        'sm_name',
        'sm_code',
        'sm_val',
        'sm_desc'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'sm_rec_status',
        'sm_rec_createdby',
        'sm_rec_created',
        'sm_rec_updatedby',
        'sm_rec_updated',
        'sm_rec_deletedby',
        'sm_rec_deleted'
    ];
}
