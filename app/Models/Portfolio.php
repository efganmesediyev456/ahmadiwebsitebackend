<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = [
        'slug',
        'title',
        'subtitle'
    ];

    protected $fillable = [
        'image'
    ];

    public function getTranslationRelationKey(): string
    {
        return 'portfolio_id';
    }
}
