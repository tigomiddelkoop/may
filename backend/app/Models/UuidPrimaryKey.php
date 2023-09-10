<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

trait UuidPrimaryKey
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
