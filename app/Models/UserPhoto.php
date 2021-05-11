<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'up_id',
        'up_u_id',
        'up_photo',
        'up_filename'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'up_rec_status',
        'up_rec_createdby',
        'up_rec_created',
        'up_rec_updatedby',
        'up_rec_updated',
        'up_rec_deletedby',
        'up_rec_deleted'
    ];
}
