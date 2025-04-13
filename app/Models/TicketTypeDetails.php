<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTypeDetails extends Model
{
    use HasFactory;
    protected $table = 'ticket_type_details';
    protected $fillable = [
        'ticket_type_id',
        'student_id',
        'user_id',
        'ticket_status',
        'ticket_description',
        'file'
    ];

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
    public function advisor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
