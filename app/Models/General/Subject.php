<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'description'
    ];

    public function classes():hasMany
    {
        return $this->hasMany(Classes::class)->using(ClassesSubject::class);
    }
}
