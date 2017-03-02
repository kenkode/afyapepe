<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
class Tag extends Model
{
  use Eloquence;

protected $searchableColumns = ['name'];
  protected $fillable = ['name'];

}
