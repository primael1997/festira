<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banniere extends Model
{
    /** @use HasFactory<\Database\Factories\BanniereFactory> */
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'btn_url',
        'status',
        'public_id'
    ];
}
