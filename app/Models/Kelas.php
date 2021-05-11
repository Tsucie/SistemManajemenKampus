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
        'kls_desc'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'kls_rec_status',
        'kls_rec_createdby',
        'kls_rec_created',
        'kls_rec_updatedby',
        'kls_rec_updated',
        'kls_rec_deletedby',
        'kls_rec_deleted'
    ];
}
