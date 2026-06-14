<?php

namespace App\Filament\Pages;

use App\Models\PropertyContent;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SeoPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationLabel = 'SEO';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $slug = 'site/seo';
    protected static ?string $title = 'SEO Settings';
    protected static string $view = 'filament.pages.hero';
    protected static ?int $navigationSort = 1;

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
                        TextInput::make('meta_title')
                            ->label('Meta title')
                            ->prefixIcon('heroicon-o-tag'),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->inline(false),
                    ]),
                Textarea::make('meta_description')
                    ->label('Meta description')
                    ->rows(2),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update($this->form->getState());

        Notification::make()
            ->title('SEO Settings updated!')
            ->success()
            ->send();
    }
}
