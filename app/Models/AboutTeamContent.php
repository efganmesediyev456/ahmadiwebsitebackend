<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutTeamContent extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = [
        'title',
        'content',
        'content2',
        'content3',
    ];

    protected $guarded = [];

    public function getTranslationRelationKey(): string
    {
        return 'about_team_id';
    }
}
