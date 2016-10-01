<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Druglist extends Model
{
  public function manufacturer()
  {
     return $this->belongsTo('App\Manufacturer'); //Profile is your profile model
  }
}
