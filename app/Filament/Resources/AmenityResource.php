<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmenityResource\Pages;
use App\Models\Amenity;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AmenityResource extends Resource
{
    protected static ?string $model = Amenity::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Amenities';
    protected static ?string $slug = 'amenidades';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon (FontAwesome)')
                            ->placeholder('fas fa-swimmer')
                            ->helperText('Search icons at ')
                            ->prefixIcon('heroicon-o-code-bracket')
                            ->suffixAction(
                                \Filament\Forms\Components\Actions\Action::make('fontawesome')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url('https://fontawesome.com/search?o=r&m=free', true)
                            )
                            ->reactive()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->prefixIcon('heroicon-o-bold')
                            ->maxLength(255),
                    ]),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->rows(4),
                Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->html()
                    ->formatStateUsing(fn ($state) => '<i class="' . $state . '" style="font-size: 1.5rem;"></i>')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->paginated(false)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAmenities::route('/'),
        ];
    }
}
