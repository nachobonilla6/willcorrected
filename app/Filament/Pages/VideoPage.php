<?php

namespace App\Filament\Pages;

use App\Models\PropertyContent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class VideoPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?string $navigationLabel = 'Video';
    protected static ?string $slug = 'video';
    protected static ?string $title = 'Video Tour';
    protected static string $view = 'filament.pages.hero';
    protected static ?int $navigationSort = 5;

    public ?array $data = [];
    public ?string $videoPreviewUrl1 = null;
    public ?string $videoPreviewUrl2 = null;

    public function mount(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $data = $content->toArray();
        foreach (['video_1_src', 'video_2_src'] as $key) {
            if (!empty($data[$key]) && is_string($data[$key])) {
                $prop = $key === 'video_1_src' ? 'videoPreviewUrl1' : 'videoPreviewUrl2';
                $this->$prop = asset($data[$key]);
                unset($data[$key]);
            }
        }
        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Group::make()
                            ->schema([
                                FileUpload::make('video_1_src')
                                    ->label('Video 1 (MP4)')
                                    ->disk('public_html')
                                    ->directory('videos')
                                    ->acceptedFileTypes(['video/mp4', 'video/ogg', 'video/webm'])
                                    ->maxSize(102400)
                                    ->previewable(true)
                                    ->openable()
                                    ->downloadable(),
                                TextInput::make('video_1_label')
                                    ->label('Label')
                                    ->placeholder('Street and Neighborhood'),
                            ]),
                        Group::make()
                            ->schema([
                                FileUpload::make('video_2_src')
                                    ->label('Video 2 (MP4)')
                                    ->disk('public_html')
                                    ->directory('videos')
                                    ->acceptedFileTypes(['video/mp4', 'video/ogg', 'video/webm'])
                                    ->maxSize(102400)
                                    ->previewable(true)
                                    ->openable()
                                    ->downloadable(),
                                TextInput::make('video_2_label')
                                    ->label('Label')
                                    ->placeholder('Outside the Complex'),
                            ]),
                    ]),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $state = $this->form->getState();
        foreach (['video_1_src', 'video_2_src'] as $key) {
            if (!empty($state[$key])) {
                if (is_array($state[$key])) {
                    $state[$key] = 'videos/' . ($state[$key][0] ?? '');
                } elseif (is_string($state[$key]) && !str_starts_with($state[$key], 'videos/')) {
                    $state[$key] = 'videos/' . $state[$key];
                }
            }
        }
        $content->update($state);

        // Refresh previews after save
        $content->refresh();
        foreach (['video_1_src' => 'videoPreviewUrl1', 'video_2_src' => 'videoPreviewUrl2'] as $src => $prop) {
            if ($content->$src) {
                $this->$prop = asset($content->$src);
            } else {
                $this->$prop = null;
            }
        }

        Notification::make()
            ->title('Video Tour updated!')
            ->success()
            ->send();
    }

    public function deleteVideo1(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update(['video_1_src' => null, 'video_1_label' => null]);
        $this->videoPreviewUrl1 = null;
        $data = $content->fresh()->toArray();
        unset($data['video_1_src']);
        $this->form->fill($data);
        $this->dispatch('$refresh');

        Notification::make()
            ->title('Video 1 removed')
            ->success()
            ->send();
    }

    public function deleteVideo2(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update(['video_2_src' => null, 'video_2_label' => null]);
        $this->videoPreviewUrl2 = null;
        $data = $content->fresh()->toArray();
        unset($data['video_2_src']);
        $this->form->fill($data);
        $this->dispatch('$refresh');

        Notification::make()
            ->title('Video 2 removed')
            ->success()
            ->send();
    }
}
