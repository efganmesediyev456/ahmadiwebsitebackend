<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = ['name', 'position'];

    protected $fillable = ['image', 'be_url', 'ln_url'];

    public function getTranslationRelationKey(): string
    {
        return 'team_id';
    }
}
