<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
class Test extends Model
{
  use Eloquence;
   protected $searchableColumns = ['name'];
   public $fillable = ['name','test_description','Date'];

}
