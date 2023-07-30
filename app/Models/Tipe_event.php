<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipe_event extends Model
{
    use HasFactory;

    protected $table = 'tipe_event';

    protected $fillable = [
        'nombre',
        'background',
        'color_text',
        'border'
    ];
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
