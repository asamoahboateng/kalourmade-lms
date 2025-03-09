<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\General\Classes;
use App\Models\General\Subject;
use App\Models\Users\ClassesUser;
use App\Models\Users\Role;
use App\Models\Users\RoleUser;
use App\Models\Users\SubjectUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'phone_number',
        'staff_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug('user'.$model->name. ' '. strtotime(now()));

            if(!isset($model->staff_id)) {
                $model->staff_id = 'st'.strtotime(now());
            }
        });
    }

//    public function user_roles(): HasMany
//    {
//        return $this->hasMany(RoleUser::class , 'user_id', 'id')->withPivot('role_id');
//    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->using(RoleUser::class);
    }

    public function classrooms(): BelongsToMany
    {
        return  $this->BelongsToMany(Classes::class)->using(ClassesUser::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)->using(SubjectUser::class);
    }
}
