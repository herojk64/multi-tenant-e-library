<?php

namespace App\Filament\TenantAdmin\Resources;

use App\Enum\BookType;
use App\Filament\TenantAdmin\Resources\BooksResource\Pages;
use App\Filament\TenantAdmin\Resources\BooksResource\RelationManagers;
use App\Models\Books;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BooksResource extends Resource
{
    protected static ?string $model = Books::class;

    protected static ?string $navigationIcon = 'heroicon-s-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([

                    Forms\Components\TextInput::make('title'),
                    Forms\Components\Textarea::make('description')->rows(5),
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\TextInput::make('author_name')->label('Author Name'),
                        Forms\Components\DatePicker::make('published_date')->label('Published Date'),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                        ,
                        Forms\Components\Select::make('type')
                            ->options([
                                BookType::FREE->value => Str::headline(BookType::FREE->value),
                                BookType::SUBSCRIBED->value => Str::headline(BookType::SUBSCRIBED->value)
                            ])
                            ->label('Type')
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\FileUpload::make('file')
                            ->label('Book/Audio')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('books')
                            ->disk('public')
                            ->openable()
                            ->columnSpan(2)
                        ->previewable()
                        ,
                        Forms\Components\FileUpload::make('thumbnail')
                        ->image()
                        ->imageEditor()
                            ->columnSpan(2)
                            ->previewable()
                            ->openable()
                            ->directory('thumbnails')
                            ->disk('public')
                    ])

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Description')->limit(50)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('author_name')->label('Author Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('published_date')->label('Published Date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')->disk('public'),
                Tables\Columns\TextColumn::make('type')->label('Type')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options([
                    BookType::FREE->value => Str::headline(BookType::FREE->value),
                    BookType::SUBSCRIBED->value => Str::headline(BookType::SUBSCRIBED->value)
                ]),
                Tables\Filters\SelectFilter::make('category_id')->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBooks::route('/create'),
            'edit' => Pages\EditBooks::route('/{record}/edit'),
        ];
    }
}
