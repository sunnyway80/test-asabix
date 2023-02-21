<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model implements TranslatableContract
{
    use HasFactory;
    use UuidTrait;
    use Translatable;
    use HasSlug;
    use SoftDeletes;

    public array $translatedAttributes = ['title', 'description', 'content'];

    protected $fillable
        = [
            'name',
        ];

    /**
     * The roles that belong to the user.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
