<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ps_id',
        'ps_fks_id',
        'ps_name',
        'ps_desc',
        'ps_rec_status',
        'ps_rec_createdby',
        'ps_rec_created',
        'ps_rec_updatedby',
        'ps_rec_updated',
        'ps_rec_deletedby',
        'ps_rec_deleted'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
