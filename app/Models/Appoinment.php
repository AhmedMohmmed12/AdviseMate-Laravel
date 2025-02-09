<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    use HasFactory;

    protected $fillable = ["user_id" , "student_id" , "app_date"  , "status"]; 


    protected $dates = [ "app_date" ];
}
