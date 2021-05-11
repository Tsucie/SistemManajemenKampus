<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'u_id',
        'u_ut_id',
        'u_username',
        'u_password',
        'u_login_time',
        'u_logout_time',
        'u_login_status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'u_rec_status',
        'u_rec_createdby',
        'u_rec_created',
        'u_rec_updatedby',
        'u_rec_updated',
        'u_rec_deletedby',
        'u_rec_deleted'
    ];
}
