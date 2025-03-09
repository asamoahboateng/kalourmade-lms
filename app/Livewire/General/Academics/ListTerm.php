<?php

namespace App\Livewire\General\Academics;

use App\Models\General\AcademicTerm;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ListTerm extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms, AuthorizesRequests;

    public function mount()
    {
        $this->authorize('viewAny', User::class);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute(__('academics.term'))
            ->query(AcademicTerm::query())
            ->columns([
                TextColumn::make('no')->rowIndex(),
                TextColumn::make('term')->searchable()->sortable(),
                IconColumn::make('is_current')->boolean(),
                TextColumn::make('start_date')->searchable()->sortable()->date('F d, Y'),
                TextColumn::make('end_date')->searchable()->sortable()->date('F d, Y'),
                TextColumn::make('academicyear.year')->searchable()->sortable(),
                TextColumn::make('createdby.name'),
            ])
            ->filters([
                TrashedFilter::make()
            ])
            ->actions([
                ViewAction::make()->slideOver()->infolist([
                    TextEntry::make('term'),
                    TextEntry::make('description'),
                    TextEntry::make('start_date')->date('F d, Y'),
                    TextEntry::make('end_date')->date('F d, Y'),
                    TextEntry::make('academicyear.year'),
                    TextEntry::make('createdby.name'),
                ]),
                EditAction::make()->slideOver()->form([
                    TextInput::make('term'),
                    Textarea::make('description'),
                    DatePicker::make('start_date')->native(false),
                    DatePicker::make('end_date')->native(false),
                    Select::make('academic_year_id')->relationship('academicyear', 'year')
                ]),
                Action::make('make-current')
                    ->icon('heroicon-s-cursor-arrow-ripple')
                    ->color('green')
                    ->action(fn (AcademicTerm $term) => $term->makeCurrent() ),
                DeleteAction::make()->authorize('update', [User::class, AcademicTerm::class]),
                RestoreAction::make()->authorize('update', [User::class, AcademicTerm::class]),
            ])
            ->bulkActions([
                DeleteBulkAction::make()->authorize('deleteAny', User::class ),
                RestoreBulkAction::make()->authorize('restoreAny', User::class ),
            ])
            ->headerActions([
                CreateAction::make()->slideOver()->model(AcademicTerm::class)
                ->authorize('create', User::class)
                ->form([
                    TextInput::make('term'),
                    Textarea::make('description'),
                    DatePicker::make('start_date')->native(false),
                    DatePicker::make('end_date')->native(false),
                    Select::make('academic_year_id')->relationship('academicyear', 'year')
                ])
            ]);
    }


    public function render()
    {
        return view('livewire.general.academics.list-term');
    }
}
