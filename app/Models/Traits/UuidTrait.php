<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

/**
 * Trait UuidTrait.
 */
trait UuidTrait
{
    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function getIdAttribute($value): mixed
    {
        if (is_object($value)) {
            return $value->toString();
        }

        return $value;
    }

    /**
     * @return UuidInterface
     */
    public function generateNewUuid(): UuidInterface
    {
        return Str::uuid();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(static function ($model) {
            $model->{$model->getKeyName()} = $model->generateNewUuid();

            return true;
        });
    }
}
