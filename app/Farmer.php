<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{

	public $primaryKey = 'fr_ID';
   	protected $fillable = ['fr_name','fr_fname', 'fr_gender', 'fr_address' , 'fr_cnic', 'fr_phone' , 'fr_city', 'fr_quota', 'fr_quota_validfrom', 'fr_quota_validtill'];
}
