<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Parent category
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    // All translations
    public function translations()
    {
        return $this->hasMany(ServiceTranslation::class, 'service_id');
    }

    // Current locale translation
    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(ServiceTranslation::class, 'service_id')
            ->where('locale', $locale);
    }

    // Accessor for easier Blade usage
    public function getTitleAttribute()
    {
        return $this->translation()->first()?->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->translation()->first()?->description;
    }
}
