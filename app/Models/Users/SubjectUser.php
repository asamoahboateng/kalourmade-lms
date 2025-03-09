<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectUser extends Pivot
{
    protected $table = 'subject_user';

    protected $fillable = [
        'subject_id',
        'user_id',
    ];

}
