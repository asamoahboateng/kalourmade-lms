<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Classes extends Model
{
    use softDeletes;
    protected $fillable = [
        'title', 'description', 'color', 'label', 'slug'
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title .' '. $model->label);
        });
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)->using(ClassesSubject::class, 'classes_subjects');
    }



}
