<?php

namespace App\Services\Registration;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 *
 */
class AvatarService
{

    /**
     * @param object $file
     * @return string
     */
    public function store(object $file): string
    {
        $name = Auth::id() . time() . Str::random(10) . '.' . $file->extension();
        if (Storage::exists('public/avatar/' . Auth::id())) {
            Storage::deleteDirectory('public/avatar/' . Auth::id());
        }
        Storage::putFileAs('public/avatar/' . Auth::id(), $file, $name);
        return $name;
    }
}
