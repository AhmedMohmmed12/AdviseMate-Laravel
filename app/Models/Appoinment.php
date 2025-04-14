<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    use HasFactory;

    protected $fillable = ["user_id" , "student_id" , "app_date"  , "status"]; 


    protected $dates = [ "app_date" ];
    
    /**
     * Get the student associated with the appointment
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
    /**
     * Get the advisor associated with the appointment
     */
    public function advisor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * Get the availability slot for this appointment
     */
    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }
}
