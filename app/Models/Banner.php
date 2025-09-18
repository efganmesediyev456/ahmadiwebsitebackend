<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = [
        'title', 
        'subtitle'
    ];

    protected $fillable = [
        'banner_url'
    ];
}
