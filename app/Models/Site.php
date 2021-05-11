<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        's_id',
        's_u_id',
        's_fullname',
        's_nidn',
        's_nidk',
        's_nip',
        's_education',
        's_experience',
        's_address',
        's_province',
        's_city',
        's_birthplace',
        's_birthdate',
        's_gender',
        's_state',
        's_email',
        's_status',
        's_contact'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        's_rec_status',
        's_rec_createdby',
        's_rec_created',
        's_rec_updatedby',
        's_rec_updated',
        's_rec_deletedby',
        's_rec_deleted'
    ];
}
