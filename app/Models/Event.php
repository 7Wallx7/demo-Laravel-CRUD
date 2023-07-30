<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable = [
        'event',
        'start_date',
        'end_date',
        'id_tipe_event',
    ];

    public function tipe_event()
    {
        return $this->belongsTo(Tipe_event::class);
    }
}
