<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'date',
        'status',
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function sponsorts()
    {
        return $this->hasMany(Sponsort::class);
    }
}
