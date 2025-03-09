<?php

namespace App\Models\General;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class AcademicYear extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'year','description','slug', 'created_by'
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug('academic year'. $model->year);
            $model->created_by = auth()->id();
        });
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
