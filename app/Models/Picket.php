<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Picket extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'picket_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
