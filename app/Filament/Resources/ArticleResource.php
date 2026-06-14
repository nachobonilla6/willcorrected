<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = '';
    protected static ?string $navigationLabel = 'Articles';
    protected static ?string $slug = 'articulos';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('source')
                    ->label('Source')
                    ->placeholder('National Geographic')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-newspaper'),
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-bold'),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->rows(2),
                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required()
                    ->maxLength(500)
                    ->prefixIcon('heroicon-o-link'),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->default(0)
                    ->prefixIcon('heroicon-o-numbered-list'),
                Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('source')->label('Source'),
                Tables\Columns\TextColumn::make('title')->label('Title')->limit(40)->searchable(),
                Tables\Columns\TextColumn::make('sort_order')->label('Order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\Action::make('open_url')
                    ->label('')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('primary')
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageArticles::route('/'),
        ];
    }
}
