<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Doctor;
use Carbon\Carbon;
use Auth;
use App\Patient;

class InfantController extends Controller
{

    public function MDetails1()
    {
          return view('doctor.motherdetails1');
    }
    public function MDetails2()
    {
          return view('doctor.motherdetails2');
    }






}
