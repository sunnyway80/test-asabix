<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPostTranslation
 */
class PostTranslation extends Model
{
    use UuidTrait;

    protected $fillable
        = [
            'title', 'description', 'content',
        ];
}
