<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fks_id',
        'fks_name',
        'fks_desc'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'fks_rec_status',
        'fks_rec_createdby',
        'fks_rec_created',
        'fks_rec_updatedby',
        'fks_rec_updated',
        'fks_rec_deletedby',
        'fks_rec_deleted'
    ];
}
