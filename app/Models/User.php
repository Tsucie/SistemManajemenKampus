<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $primaryKey = 'u_id';

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

    /**
     * Eloquent Relationships
     */
    public function hasPhoto()
    {
        return $this->hasOne(UserPhoto::class, 'up_u_id', 'u_id');
    }

    public function hasClient()
    {
        return $this->hasOne(Client::class, 'c_u_id', 'u_id');
    }

    public function hasSite() 
    {
        return $this->hasOne(Site::class, 's_u_id', 'u_id');
    }

    public function hasStaff()
    {
        return $this->hasOne(Staff::class, 'stf_u_id', 'u_id');
    }
}
