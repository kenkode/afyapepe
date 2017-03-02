<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Disease extends Model
{

  use Eloquence;
  protected $table = 'diseases';
  protected $searchableColumns = ['short_desc'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','short_desc','long_desc'];
}
