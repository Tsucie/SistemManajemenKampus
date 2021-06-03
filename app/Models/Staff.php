<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stf_id',
        'stf_u_id',
        'stf_sc_id',
        'stf_fks_id',
        'stf_ps_id',
        'stf_mk_id',
        'stf_fullname',
        'stf_num_stat',
        'stf_nidn',
        'stf_nidk',
        'stf_nip',
        'stf_nik',
        'stf_education',
        'stf_experience',
        'stf_address',
        'stf_province',
        'stf_city',
        'stf_birthplace',
        'stf_birthdate',
        'stf_gender',
        'stf_state',
        'stf_email',
        'stf_status',
        'stf_contact',
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
        'stf_rec_status',
        'stf_rec_createdby',
        'stf_rec_created',
        'stf_rec_updatedby',
        'stf_rec_updated',
        'stf_rec_deletedby',
        'stf_rec_deleted'
    ];

    /**
     * Eloquent Relationship
     * Get staff_category that owns the staff (One-To-Many(Inverse) or Many-To-One)
     */
    public function staff_category()
    {
        //                      The ParentTbl,        child_fk,  parent_id
        return $this->belongsTo(StaffCategory::class,'stf_sc_id','sc_id');
    }
}
