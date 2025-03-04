<?php

namespace App\Livewire\General;

use App\Models\General\Classes;
use App\Models\User;
use App\Policies\ClassesPolicy;
use App\Services\ClassesForm;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Columns\ColorColumn;
use Filament\Infolists\Components\ColorEntry;


class ListClasses extends Component implements HasTable, HasForms
{
    use InteractsWithForms, InteractsWithTable, AuthorizesRequests;

    public function mount() {
        $this->authorize( 'viewAny', User::class);
    }

    public function render()
    {
        return view('livewire.general.list-classes')
            ->layout('components.layouts.app');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->query(Classes::query())
            ->columns([
                TextColumn::make('No.')->rowIndex(),
                TextColumn::make('title')->formatStateUsing(fn (string $state) => ucfirst($state))->sortable()->searchable(),
                TextColumn::make('label')->formatStateUsing(fn (string $state) => ucfirst($state))->sortable()->searchable(),
                ColorColumn::make('color'),
                TextColumn::make('subjects_count')->counts('subjects'),
                TextColumn::make('description'),
//                TextColumn::make('deleted_at')
//                    ->badge()
//                    ->formatStateUsing(fn ($state) => $state === null ? 'Not Deleted' : 'Deleted')
//                    ->color(fn ($state): string => $state === null ? 'success' : 'danger')
            ])
            ->filters([
                TrashedFilter::make()
            ])
            ->actions([
                ViewAction::make()
                    ->slideOver()
                    ->infolist([
                        TextEntry::make('title'),
                        TextEntry::make('label'),
                        ColorEntry::make('color'),
                        TextEntry::make('description'),
                        TextEntry::make('subjects.title')->badge()->separator(','),
                    ]),
                EditAction::make()->slideOver()->form(ClassesForm::schema())
                    ->authorize('update', [User::class, Classes::class]),
                DeleteAction::make()
                    ->authorize('delete', [User::class, Classes::class]),
                RestoreAction::make()
                    ->authorize('update', [User::class, Classes::class]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                RestoreBulkAction::make()
            ])
            ->headerActions([
                CreateAction::make()
                    ->authorize('create', [User::class])
                    ->slideOver()
                    ->model(Classes::class)
                    ->form( ClassesForm::schema() ),
            ]);
    }
}
