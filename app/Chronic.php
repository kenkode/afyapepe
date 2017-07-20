<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;


class Chronic extends Model
{
    use Eloquence;
     protected $table = 'diagnoses';
protected $searchableColumns = ['name'];
}
