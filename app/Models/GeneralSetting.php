<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'site_name',
        'email',
        'phone',
        'contact_address',
        'fb',
        'insta',
    ];
}
