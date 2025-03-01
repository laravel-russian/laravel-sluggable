<?php

namespace LaravelRussian\Sluggable\Tests\TestSupport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelRussian\Sluggable\HasTranslatableSlug;
use LaravelRussian\Sluggable\SlugOptions;
use LaravelRussian\Translatable\HasTranslations;

class TranslatableModel extends Model
{
    use HasTranslations;
    use HasTranslatableSlug;

    protected $table = 'translatable_models';

    protected $guarded = [];
    public $timestamps = false;

    protected array $translatable = ['name', 'other_field', 'slug'];

    private ?SlugOptions $customSlugOptions = null;

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

    public function testModel(): BelongsTo
    {
        return $this->belongsTo(TestModel::class);
    }
}
