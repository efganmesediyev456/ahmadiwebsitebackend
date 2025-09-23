<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhoWeDo extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [];

    public function getTranslationRelationKey(): string
    {
        return 'who_we_do_id';
    }

    public function items(){
        return $this->hasMany(WhoWeDoItem::class);
    }
}
