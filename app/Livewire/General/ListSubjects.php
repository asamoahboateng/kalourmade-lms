<?php

namespace App\Livewire\General;

use App\Models\General\Subject;
use App\Models\User;
use App\Models\User as ModelsUser;
use App\Policies\SubjectPolicy;
use App\Services\UserForm;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Services\SubjectForm;

class ListSubjects extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms, AuthorizesRequests;

    public function mount() {
        $this->authorize( 'viewAny', User::class);
    }

    public function render()
    {
        return view('livewire.general.list-subjects')
            ->layout('components.layouts.app');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->query(Subject::query())
            ->columns([
                TextColumn::make('No.')->rowIndex(),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('description'),
                TextColumn::make('deleted_at')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === null ? 'Not Deleted' : 'Deleted')
                    ->color(fn ($state): string => $state === null ? 'success' : 'danger')
            ])
            ->filters([
                TrashedFilter::make()
            ])
            ->actions([
                ViewAction::make()
                    ->slideOver()
                    ->infolist([
                        TextEntry::make('title'),
                        TextEntry::make('description'),
                    ]),
                EditAction::make()->slideOver()->form(SubjectForm::schema())
                    ->authorize('update', [User::class, Subject::class]),
                DeleteAction::make()
                    ->authorize('delete', [User::class, Subject::class]),
                RestoreAction::make()
                    ->authorize('update', [User::class, Subject::class]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                RestoreBulkAction::make()
            ])
            ->headerActions([
                CreateAction::make()
                    ->authorize('create', [User::class])
                    ->slideOver()
                    ->model(Subject::class)
                    ->form( SubjectForm::schema() ),
            ]);
    }
}
