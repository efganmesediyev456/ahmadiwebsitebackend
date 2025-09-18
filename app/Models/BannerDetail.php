<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannerDetail extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = [
        'title', 
        'url'
    ];

    public function getTranslationRelationKey(): string
    {
        return 'banner_id';
    }
}
