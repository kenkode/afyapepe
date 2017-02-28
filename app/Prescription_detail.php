<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription_detail extends Model
{
  public $fillable = ['presc_id','drug_id','doseform',
  'dosage','diagnosis','strength','routes','frequency','created_at','updated_at'];

  protected $casts = [];
}
