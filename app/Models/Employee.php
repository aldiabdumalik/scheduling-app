<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nik',
        'whatsapp',
        'avatar',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function picket()
    {
        return $this->hasOne(Picket::class, 'employee_id', 'id');
    }
}
