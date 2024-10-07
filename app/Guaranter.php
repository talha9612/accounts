<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guaranter extends Model
{
    public $primaryKey = 'gr_ID';
   	protected $fillable = ['gr_name','gr_fname', 'gr_gender', 'gr_address' , 'gr_cnic', 'gr_phone'];
}
