<?php
namespace App\Services;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class ClassesForm {

    public  static function schema(): array
    {
        return [
            TextInput::make('title')->required(),
            TextInput::make('label')->required(),
            Forms\Components\ColorPicker::make('color')->required(),
            Textarea::make('description')->required(),
            Forms\Components\Select::make('subjects')->relationship('subjects', 'title')->multiple(),
        ];
    }
}
