<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Doctor extends Model

{

use Eloquence;

protected $searchableColumns = ['name'];

    public $fillable = ['user_id','name','regdate','regno','address',
    'qualifications','speciality','subspeciality','phone','residence','facility'];

}
