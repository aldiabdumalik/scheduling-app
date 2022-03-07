<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'event_name',
        'event_start',
        'event_end',
        'event_color',
        'event_category',
        'from_api'
    ];
}
