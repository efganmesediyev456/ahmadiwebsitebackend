<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyAboutPage extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = [
        'title',
        'content',
        'content2',
        'content3',
        'founded',
        'team',
    ];

    protected  $guarded = [];


     public function getTranslationRelationKey(): string
    {
        return 'company_id';
    }
}
