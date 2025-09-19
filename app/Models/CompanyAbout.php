<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyAbout extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = [
        'title',
        'subtitle',
        'url'
    ];

    protected $fillable = [];

    public function getTranslationRelationKey(): string
    {
        return 'company_about_id';
    }
}
