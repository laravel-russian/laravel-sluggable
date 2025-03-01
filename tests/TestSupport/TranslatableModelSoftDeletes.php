<?php

namespace LaravelRussian\Sluggable\Tests\TestSupport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelRussian\Sluggable\HasTranslatableSlug;
use LaravelRussian\Sluggable\SlugOptions;
use LaravelRussian\Translatable\HasTranslations;

class TranslatableModelSoftDeletes extends Model
{
    use HasTranslations;
    use HasTranslatableSlug;
    use SoftDeletes;

    protected $table = 'translatable_model_soft_deletes';

    protected $guarded = [];
    public $timestamps = false;

    protected array $translatable = ['name', 'other_field', 'slug'];

    protected ?SlugOptions $customSlugOptions = null;

    public function useSlugOptions(SlugOptions $slugOptions)
    {
        $this->customSlugOptions = $slugOptions;
    }

    public function getSlugOptions(): SlugOptions
    {
        return $this->customSlugOptions ?: SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
