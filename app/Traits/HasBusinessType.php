<?php

namespace App\Traits;

use App\Scopes\BusinessTypeScope;

trait HasBusinessType
{
    /**
     * Boot the trait.
     */
    protected static function bootHasBusinessType(): void
    {
        static::addGlobalScope(new BusinessTypeScope);
    }

    /**
     * Get the business type.
     */
    public function getBusinessTypeAttribute(): string
    {
        return $this->attributes['business_type'] ?? session('business_type', 'construction');
    }

    /**
     * Set the business type.
     */
    public function setBusinessTypeAttribute(string $value): void
    {
        $this->attributes['business_type'] = $value;
    }
}
