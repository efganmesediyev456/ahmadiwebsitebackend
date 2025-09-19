<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MobilProgram extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = [
        'url'
    ];

    protected $fillable = [
        'image',
        'left_or_right',
    ];

    public function getTranslationRelationKey(): string
    {
        return 'mobil_program_id';
    }
}
