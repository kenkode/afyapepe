<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Patienttest extends Model
{
  /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'patient_test';

   public $fillable = ['patient_id','appointment_id','doc_id','test_status','test_reccommended','conditional_diagnosis','doc_note'];
   protected $casts = [

    ];
}
