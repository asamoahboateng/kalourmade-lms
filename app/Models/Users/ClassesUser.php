<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassesUser extends Pivot
{
    protected $table = 'classes_user';

    protected $fillable = [
        'classes_id',
        'user_id',
    ];

}
