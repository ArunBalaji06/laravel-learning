<?php

namespace App\Base\Uuid;
use Ramsey\Uuid\Uuid;

trait UuidModel {
    /**
     * Get the value indicating whether the IDs are incrementing.
     * Overwrite the method to always return false to disable auto incrementing as we are using UUID.
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Binds creating event to insert an auto generated UUID.
     *
     * @return void
     */
    public static function bootUuidModel() {
        static::creating(function ($model) {
            $model->attributes[$model->getKeyName()] = Uuid::uuid4();
        });
    }

    /**
     * Generate an auto generated UUID.
     *
     * @return \Ramsey\Uuid\UuidInterface
     */
    public static function getUuid(): \Ramsey\Uuid\UuidInterface
    {
        return Uuid::uuid4();
    }

}
