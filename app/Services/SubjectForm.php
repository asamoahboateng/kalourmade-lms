<?php
namespace App\Services;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class SubjectForm {

    public  static function schema(): array
    {
        return [
            TextInput::make('title')->required(),
            Textarea::make('description')->required(),
        ];
    }
}
