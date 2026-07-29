<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerie extends Model
{
    /** @use HasFactory<\Database\Factories\GallerieFactory> */
    use HasFactory;

    public function getImagesArrayAttribute(): array
    {
        if (blank($this->images)) {
            return [];
        }

        $decoded = json_decode($this->images, true);

        return is_array($decoded) ? $decoded : array_map('trim', explode(',', $this->images));
    }
}
