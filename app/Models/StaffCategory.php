<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sc_id',
        'sc_name',
        'sc_desc'
    ];

    /**
     * Eloquent Relationship
     * Get all staffs for a staff_category (One-To-Many)
     */
    public function staffs()
    {
        //                    The ChildTbl, child_fk,  parent_id
        return $this->hasMany(Staff::class,'stf_sc_id','sc_id');
    }
}
