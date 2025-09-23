<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Management extends BaseModel
{
    use HasFactory;

    public $table = "managements";

    public $translatedAttributes = ['name', 'position', 'description'];

    protected $fillable = ['image', 'be_url', 'ln_url'];

    public function getTranslationRelationKey(): string
    {
        return 'management_id';
    }
}
