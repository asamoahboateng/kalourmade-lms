<?php

namespace App\Livewire\Users\Profile;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;


class UserProfile extends Component implements  HasForms
{
    use InteractsWithForms, AuthorizesRequests;

    public ?array $data = [];

//[▼
//0 => array:2 [▼
//"type" => "Text Field"
//"data" => array:2 [▼
//"title" => "trtr"
//"description" => "rtrt"
//]
//]
//]

    public function mount(User $user, $slug)
    {
        // sample structure of data
        $data = [];

        $data = [ 'contents' => [
            [
                'type' => 'Text Field',
                'data' => [
                    'title' => 'House Address',
                    'description' => '23 Senecal Hill dr',
                ]
            ],
            [
                'type' => 'Text Area',
                'data' => [
                    'title' => 'Property Description',
                    'description' => 'A spacious 3-bedroom home...',
                ]
            ],
            [
                'type' => 'image',
                'data' => [
                    'title' => 'Property Description',
                    'url' => '/user-profiles/01JNVZX7V4EA08XZR4SNK87FTA.jpg',
                ]
            ]
        ]];
        /**/
        $this->data = $data;
        $this->form->fill($this->data);
//        dd($this->data);
    }

    public function render()
    {
        return view('livewire.users.profile.user-profile')
            ->layout('components.layouts.app');
    }

//    public function table(Table $table): Table
//    {
//        return $table
//            ->recordTitleAttribute('User Profile')
//            ->query(User::query());
//
//    }

    public function create(): void
    {
        dd($this->form->getState()['contents']);
    }

    public function form(Form $form): Form
    {
        return $form->schema([

                Builder::make('contents')
                ->blocks([
                    // text field
                  Builder\Block::make('Text Field')
                  ->schema([
                      TextInput::make('title')->label('Title'),
                      TextInput::make('description')->label('Description'),
                  ])->columns(2)->icon('heroicon-m-bars-2'),
                  // text area
                  Builder\Block::make('Text Area')
                    ->schema([
                        TextInput::make('title')->label('Title'),
                        Textarea::make('description')->label('Description'),
                    ])->icon('heroicon-m-bars-3-bottom-left'),
                  // image field
                  Builder\Block::make('image')
                    ->schema([
                        TextInput::make('title')->label('Field Title')->required(),
                        FileUpload::make('url')->label('Image')->image()->required()->directory('user-profiles')->openable(),
                    ])->columns(2)->icon('heroicon-m-photo'),

                ])->blockNumbers(false)->blockIcons()->minItems(1)->maxItems(5)

            ])
            ->statePath('data');
    }

}
