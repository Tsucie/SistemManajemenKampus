<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'c_id',
        'c_u_id',
        'c_code',
        'c_name',
        'c_remark',
        // Users
        'u_username',
        'u_password',
        // UserPhoto
        'up_id',
        'up_photo',
        'up_filename'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'c_rec_status',
        'c_rec_createdby',
        'c_rec_created',
        'c_rec_updatedby',
        'c_rec_updated',
        'c_rec_deletedby',
        'c_rec_deleted'
    ];
}
