<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTagTranslation
 */
class TagTranslation extends Model
{
    use UuidTrait;

    protected $fillable
        = [
            'name',
        ];
}
