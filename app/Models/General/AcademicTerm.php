<?php

namespace App\Models\General;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class AcademicTerm extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'term','description','slug', 'created_by', 'start_date', 'end_date', 'academic_year_id', 'is_current'
    ];

    protected $with = ['academicYear'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug('academic term'. $model->term);
            $model->created_by = auth()->id();
        });
    }
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /* make the term the current one */
    public function makeCurrent()
    {
        $this->is_current = true;
        $this->save();

        AcademicTerm::where('id' ,'!=', $this->id)->update(['is_current' => false]);
        Notification::make()
            ->title('Update successfully')
            ->success()
            ->send();
        return;
    }
}
