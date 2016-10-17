<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model

{

    public $fillable = ['user_id','name','regdate','regno','address',
    'qualifications','speciality','subspeciality','phone','residence','facility'];

}
