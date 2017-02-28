<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
  public $fillable = [
'FacilityCode','FacilityName','registration_no','KEPHLevel','Type','Owner','regulatory_body','Beds',
'Cots','County','Constituency','sub_county','Ward','OperationalStatus','Open24Hours','OpenPublicHolidays',
'OpenWeekends','OpenLateNight','Approved','PublicVisible','closed'];
}
