<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhoWeDoItem extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['who_we_do_id'];

    public function whoWeDo()
    {
        return $this->belongsTo(WhoWeDo::class);
    }

    public function getTranslationRelationKey(): string
    {
        return 'who_we_do_item_id';
    }
}
