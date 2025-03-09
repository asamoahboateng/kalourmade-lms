<?php

namespace App\Livewire\General\Academics;

use App\Models\General\AcademicYear;
use App\Models\User;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ListYear extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms, AuthorizesRequests;

    public function mount()
    {
        $this->authorize('viewAny', User::class);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute(__('academics.year'))
            ->query(AcademicYear::query())
            ->columns([
                TextColumn::make('No.')->rowIndex(),
                TextColumn::make('year')->sortable()->searchable(),
                TextColumn::make('description'),
                TextColumn::make('createdby.name'),
            ])
            ->filters([
                TrashedFilter::make()
            ])
            ->actions([
                ViewAction::make()->slideOver()->infolist([
                    TextEntry::make('year'),
                    TextEntry::make('description'),
                ]),
                EditAction::make()->slideOver()->form([
                    TextInput::make('year'),
                    Textarea::make('description'),
                ])->authorize('update', [User::class, AcademicYear::class]),
                DeleteAction::make()->authorize('update', [User::class, AcademicYear::class]),
                RestoreAction::make()->authorize('update', [User::class, AcademicYear::class]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                RestoreBulkAction::make()
            ])
            ->headerActions([
                CreateAction::make()->slideOver()->model(AcademicYear::class)
                    ->authorize('create', User::class)
                    ->form([
                        TextInput::make('year'),
                        Textarea::make('description'),
                    ]),
            ]);
    }


    public function render()
    {
        return view('livewire.general.academics.list-year');
    }
}
