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

   public $fillable = ['appointment_id','doc_id','test_reccommended','doc_note'];
   protected $casts = [

    ];
}
