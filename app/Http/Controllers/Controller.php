<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * The admin stores uploads as relative paths ("uploads/x.jpg"), which would
     * resolve against the current URL in the browser. Make them root-relative
     */
    protected function publicUrl(?string $path): ?string
    {
        if (blank($path) || str_starts_with($path, 'http')) {
            return $path;
        }

        return '/'.ltrim($path, '/');
    }
}
