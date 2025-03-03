<?php

namespace App\Models\Users;

use App\Models\User;
use App\Policies\RolePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'title','description', 'slug'
    ];

//    protected $policies = [
//        Role::class => RolePolicy::class
//    ];

    protected static function boot(): void
    {
//        $this->registerPolicies();
        parent::boot();
//        $this->registerPolicies();

        static::creating(function ($model) {
            $model->slug = Str::slug('user role '.$model->title);
        });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(RoleUser::class);
    }

}
