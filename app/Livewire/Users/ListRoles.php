<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Models\Users\Role;
use App\Services\RoleForm;
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
use Livewire\Component;

class ListRoles extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms, AuthorizesRequests;
    public $tableTable;

    public function mount() {
        $this->authorize( 'viewAny', Role::class);
    }
    public function render()
    {
        return view('livewire.users.roles.list-roles')
            ->layout('components.layouts.app');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->query(Role::query())
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('description'),
                TextColumn::make('users_count')->counts('users'),
                TextColumn::make('created_at')->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver()
                    ->infolist([
                        TextEntry::make('title'),
                        TextEntry::make('description'),
                    ])
                    ->authorize('view',[User::class, Role::class]),
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form(RoleForm::schema())
                    ->authorize('update',[User::class, Role::class])
                ,
                Tables\Actions\DeleteAction::make()->authorize('delete',[User::class, Role::class]),
                Tables\Actions\RestoreAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make()
            ])
            ->headerActions([
                CreateAction::make()
                    ->slideOver()
                    ->model(Role::class)
                    ->form( RoleForm::schema() ),
            ]);
    }

//    public function render()
//    {
//        return view('livewire.users.list-roles')->with([
//            'tablet' => '233',
//        ]);
//    }
}
