<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use  Spatie\MediaLibrary\MediaCollections\MediaCollection;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('articles')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300);

    }


    public static function last()
    {
        return static::all()->last();
    }

}
