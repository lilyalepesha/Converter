<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class GroupImage extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'group_name',
        'image_name',
        'zip_id'
    ];
}
