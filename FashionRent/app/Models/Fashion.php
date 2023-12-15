<?php

namespace App\Models;

use App\Models\Category;
use App\Models\FashionCategory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fashion extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'fashion_code', 'title', 'cover', 'slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'fashion_category', 'fashion_id', 'category_id');
    }

    public function fashionCategories()
    {
        return $this->hasMany(FashionCategory::class);
    }

    public function rentLogs(): HasMany
    {
        return $this->hasMany(RentLogs::class, 'fashion_id', 'id');
    }
}
