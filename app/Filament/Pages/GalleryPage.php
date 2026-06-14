<?php

namespace App\Filament\Pages;

use App\Models\GalleryImage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;

class GalleryPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Photo Gallery';
    protected static ?string $slug = 'photo-gallery';
    protected static ?string $title = 'Photo Gallery';
    protected static string $view = 'filament.pages.gallery';
    protected static ?int $navigationSort = 4;

    public ?array $data = [];
    public $photos = [];

    public function mount(): void
    {
        $this->loadPhotos();
    }

    public function loadPhotos(): void
    {
        $this->photos = GalleryImage::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->toArray();
    }

    public function uploadPhotos(): void
    {
        $files = $this->form->getState()['new_photos'] ?? [];

        if (empty($files)) {
            Notification::make()
                ->title('Select at least one file')
                ->warning()
                ->send();
            return;
        }

        $maxOrder = GalleryImage::max('sort_order') ?? 0;

        foreach ($files as $file) {
            GalleryImage::create([
                'image_path' => '/' . $file,
                'sort_order' => ++$maxOrder,
                'is_active' => true,
            ]);
        }

        $this->form->fill();
        $this->loadPhotos();

        Notification::make()
            ->title(count($files) . ' photo(s) uploaded')
            ->success()
            ->send();
    }

    public function deletePhoto(int $id): void
    {
        $photo = GalleryImage::find($id);
        if ($photo) {
            Storage::disk('public_html')->delete($photo->image_path);
            $photo->delete();
            $this->loadPhotos();
            Notification::make()
                ->title('Photo deleted')
                ->success()
                ->send();
        }
    }

    public function moveUp(int $id): void
    {
        $current = GalleryImage::find($id);
        if (!$current) return;

        $prev = GalleryImage::where('sort_order', '<', $current->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        if ($prev) {
            $temp = $current->sort_order;
            $current->update(['sort_order' => $prev->sort_order]);
            $prev->update(['sort_order' => $temp]);
            $this->loadPhotos();
        }
    }

    public function moveDown(int $id): void
    {
        $current = GalleryImage::find($id);
        if (!$current) return;

        $next = GalleryImage::where('sort_order', '>', $current->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        if ($next) {
            $temp = $current->sort_order;
            $current->update(['sort_order' => $next->sort_order]);
            $next->update(['sort_order' => $temp]);
            $this->loadPhotos();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('new_photos')
                    ->label('')
                    ->disk('public_html')
                    ->directory('gallery')
                    ->multiple()
                    ->image()
                    ->imagePreviewHeight('150')
                    ->panelLayout('grid')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxFiles(20)
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
