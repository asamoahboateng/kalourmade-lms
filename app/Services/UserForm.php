<?php
namespace App\Services;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

final class UserForm {

    public  static function schema(): array
    {
        return [
            TextInput::make('name')->required(),
            TextInput::make('email')->required(),
            TextInput::make('password')->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),
            Forms\Components\Select::make('roles')->relationship('roles', 'title')->multiple(),
        ];
    }
}
