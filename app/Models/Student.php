<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity, HasRoles;

    protected $fillable = [
        'Fname',
        'LName', 
        'email',
        'program',
        'phoneNumber',
        'gender',
        'password',
        'status',
        'user_id'
    ];  

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['Fname', 'LName', 'email', 'status']) 
            ->logOnlyDirty() 
            ->setDescriptionForEvent(fn(string $eventName) => "Student has been {$eventName}")
            ->useLogName('student');
    }

    /**
     * Get the ticket type detail associated with the student.
     */
    public function ticketTypeDetail()
    {
        return $this->belongsTo(\App\Models\TicketTypeDetail::class);
    }

    /**
     * Get the advisor associated with the student.
     */
    public function advisor()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function tickets()
    {
        return $this->hasMany(TicketTypeDetails::class, 'student_id');
    }
}
