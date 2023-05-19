<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;

/**
 *
 */
class Image extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function zip(): BelongsTo
    {
        return $this->belongsTo(Zip::class);
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'file',
        'path',
        'type',
        'width',
        'url',
        'height',
        'group_id',
        'original_width',
        'original_height'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(GroupImage::class);
    }

}
