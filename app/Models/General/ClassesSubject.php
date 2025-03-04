<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassesSubject extends Pivot
{
    protected $table = 'classes_subject';

    protected $fillable = [
        'classes_id', 'subject_id'
    ];
}
