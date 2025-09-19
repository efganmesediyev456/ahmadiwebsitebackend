<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = ['url'];

    protected $fillable = ['image', 'floor'];

    public function getTranslationRelationKey(): string
    {
        return 'partner_id';
    }
}
