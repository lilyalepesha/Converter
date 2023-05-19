<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class ImageToZip extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'image_zip';

    /**
     * @var string[]
     */
    protected $fillable = [
        'image_id', 'zip_id'
    ];


}
