<?php

namespace App\Models\Student;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guardian extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'phone', 'other_phone', 'address', 'occupation', 'user_id', 'slug'
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug('guardian'.$model->name. ' '. strtotime(now()));
        });
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
