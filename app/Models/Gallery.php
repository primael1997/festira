<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
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
