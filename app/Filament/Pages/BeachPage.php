<?php

namespace App\Filament\Pages;

use App\Models\PropertyContent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;

class BeachPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sun';
    protected static ?string $navigationLabel = 'Beach';
    protected static ?string $slug = 'site/beach';
    protected static ?string $title = 'Beach Section';
    protected static string $view = 'filament.pages.hero';
    protected static ?int $navigationSort = 6;

    public ?array $data = [];
    public ?string $beachPreviewUrl1 = null;
    public ?string $beachPreviewUrl2 = null;

    public function mount(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $this->form->fill($content->toArray());

        foreach (['beach_image_1', 'beach_image_2'] as $key) {
            if (!empty($content->$key)) {
                $prop = $key === 'beach_image_1' ? 'beachPreviewUrl1' : 'beachPreviewUrl2';
                $this->$prop = asset($content->$key);
            }
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        FileUpload::make('beach_image_1')
                            ->label('Beach Photo 1')
                            ->disk('public_html')
                            ->directory('lp-photos')
                            ->image()
                            ->imagePreviewHeight('200')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                        FileUpload::make('beach_image_2')
                            ->label('Beach Photo 2')
                            ->disk('public_html')
                            ->directory('lp-photos')
                            ->image()
                            ->imagePreviewHeight('200')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ]),
                Grid::make(2)
                    ->schema([
                        Textarea::make('beach_intro')
                            ->label('Intro')
                            ->rows(3),
                        Textarea::make('beach_text_1')
                            ->label('Text 1')
                            ->rows(3),
                    ]),
                Grid::make(2)
                    ->schema([
                        Textarea::make('beach_text_2')
                            ->label('Text 2')
                            ->rows(3),
                        TextInput::make('beach_highlights_title')
                            ->label('Highlights title')
                            ->prefixIcon('heroicon-o-list-bullet'),
                    ]),
                Grid::make(2)
                    ->schema([
                        TextInput::make('surfing_title')
                            ->label('Surfing title')
                            ->prefixIcon('heroicon-o-sparkles'),
                        TextInput::make('sunset_title')
                            ->label('Sunset title')
                            ->prefixIcon('heroicon-o-sun'),
                    ]),
                Textarea::make('surfing_text')
                    ->label('Surfing text')
                    ->rows(3),
                Textarea::make('sunset_text')
                    ->label('Sunset text')
                    ->rows(3),
                Repeater::make('beach_highlights')
                    ->label('Highlights')
                    ->schema([
                        TextInput::make('text')
                            ->prefixIcon('heroicon-o-check-circle'),
                    ])
                    ->defaultItems(0)
                    ->grid(2),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $state = $this->form->getState();

        foreach (['beach_image_1', 'beach_image_2'] as $key) {
            if (empty($state[$key])) {
                unset($state[$key]);
            } elseif (is_array($state[$key])) {
                $state[$key] = 'lp-photos/' . ($state[$key][0] ?? '');
            } elseif (is_string($state[$key]) && !str_starts_with($state[$key], 'lp-photos/')) {
                $state[$key] = 'lp-photos/' . $state[$key];
            }
        }

        $content->update($state);

        // Refresh previews after save
        $content->refresh();
        foreach (['beach_image_1' => 'beachPreviewUrl1', 'beach_image_2' => 'beachPreviewUrl2'] as $src => $prop) {
            if ($content->$src) {
                $this->$prop = asset($content->$src);
            } else {
                $this->$prop = null;
            }
        }

        $this->form->fill($content->toArray());

        Notification::make()
            ->title('Beach Section updated!')
            ->success()
            ->send();
    }

    public function deleteBeach1(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        if ($content->beach_image_1) {
            Storage::disk('public_html')->delete($content->beach_image_1);
        }
        $content->update(['beach_image_1' => null]);
        $this->beachPreviewUrl1 = null;
        $this->form->fill($content->fresh()->toArray());
        $this->dispatch('$refresh');

        Notification::make()
            ->title('Beach Photo 1 removed')
            ->success()
            ->send();
    }

    public function deleteBeach2(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        if ($content->beach_image_2) {
            Storage::disk('public_html')->delete($content->beach_image_2);
        }
        $content->update(['beach_image_2' => null]);
        $this->beachPreviewUrl2 = null;
        $this->form->fill($content->fresh()->toArray());
        $this->dispatch('$refresh');

        Notification::make()
            ->title('Beach Photo 2 removed')
            ->success()
            ->send();
    }
}
