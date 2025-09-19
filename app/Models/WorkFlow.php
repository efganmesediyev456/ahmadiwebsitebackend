<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkFlow extends BaseModel
{
    use HasFactory;

    public $translatedAttributes = [
        'title',
        'subtitle',
        'url',
    ];

    protected $fillable = [];

    public function getTranslationRelationKey(): string
    {
        return 'work_flow_id';
    }
}
