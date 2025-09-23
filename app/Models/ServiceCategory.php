<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function translations()
    {
        return $this->hasMany(ServiceCategoryTranslation::class, 'service_category_id');
    }


    public function services()
    {
        return $this->hasMany(Service::class, 'category_id', 'id');
    }

}
