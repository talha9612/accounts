<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	public $primaryKey = 'tr_ID';
	 
    protected $fillable = ['tr_name','tr_fname', 'tr_gender', 'tr_cnic', 'tr_phone', 'tr_address', 'tr_city', 'tr_quota', 'tr_quota_validfrom', 'tr_quota_validtill', 'assoc_area', 'assoc_city', 'assoc_ID'];
}
