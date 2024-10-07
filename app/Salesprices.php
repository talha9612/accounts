<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesprices extends Model
{
   public $primaryKey = 'slp_ID';
   protected $fillable = ['slp_make','slp_item', 'slp_model', 'slp_quantity', 'slp_lot', 'slp_cp', 'slp_sp', 'slp_cceall', 'slp_cce', 'slp_ep', 'slp_newsalesprice'];
}
