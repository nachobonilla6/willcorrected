<?php

namespace App\Filament\Pages;

use App\Models\PropertyContent;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ContactPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationLabel = 'Contact';
    protected static ?string $navigationGroup = '';
    protected static ?string $slug = 'site/contact';
    protected static ?string $title = 'Contact Section';
    protected static string $view = 'filament.pages.hero';
    protected static ?int $navigationSort = 7;

    public ?array $data = [];

    public function mount(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $this->form->fill($content->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('contact_title')
                            ->label('Title')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-bold'),
                        TextInput::make('owner_name')
                            ->label('Owner name')
                            ->prefixIcon('heroicon-o-user'),
                    ]),
                Textarea::make('contact_intro')
                    ->label('Intro')
                    ->rows(4),
                Grid::make(3)
                    ->schema([
                        TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->prefixIcon('heroicon-o-envelope'),
                        TextInput::make('contact_phone')
                            ->label('Phone')
                            ->prefixIcon('heroicon-o-phone'),
                        TextInput::make('contact_whatsapp')
                            ->label('WhatsApp')
                            ->prefixIcon('heroicon-o-chat-bubble-oval-left-ellipsis'),
                    ]),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update($this->form->getState());

        Notification::make()
            ->title('Contact Section updated!')
            ->success()
            ->send();
    }
}
