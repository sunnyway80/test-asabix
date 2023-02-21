<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperTag
 */
class Tag extends Model implements TranslatableContract
{
    use HasFactory;
    use UuidTrait;
    use Translatable;
    use SoftDeletes;

    public array $translatedAttributes = ['name'];

    /**
     * The roles that belong to the user.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
