<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends BaseModel
{
    use HasFactory;


    public $translatedAttributes = ['address','terms_and_condition','start_a_project_url'];

    protected $guarded = [];
}