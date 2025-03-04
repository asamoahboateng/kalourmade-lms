<?php

namespace App\Livewire\Users;

use App\Models\User as ModelsUser;
use App\Policies\UserPolicy;
use App\Services\RoleForm;
use App\Services\UserForm;
use Livewire\Component;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\View;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PhpParser\Builder;

class User extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms, AuthorizesRequests;

    public function mount() {
        $this->authorize( 'viewAny', User::class);
    }

    public function render()
    {
        return view('livewire.users.user')
            ->layout('components.layouts.app');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->query(ModelsUser::query())
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('created_at')->sortable(),
                TextColumn::make('roles.title')->badge()->separator(',')->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver()
                    ->infolist([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('created_at'),
                        TextEntry::make('roles.title'),
                    ])
                    ->authorize('view',[ ModelsUser::class, ModelsUser::class]),
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(UserForm::schema())
                    ->authorize('update',[ModelsUser::class, ModelsUser::class])
                ,
                Tables\Actions\DeleteAction::make()->authorize('delete',[ModelsUser::class, ModelsUser::class]),
                Tables\Actions\RestoreAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make()
            ])
            ->headerActions([
                CreateAction::make()
                    ->authorize('create', [ModelsUser::class])
                    ->slideOver()
                    ->model(ModelsUser::class)
                    ->form( UserForm::schema() ),
            ]);
    }
}
