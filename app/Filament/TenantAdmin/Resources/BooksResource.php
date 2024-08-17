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

                    Forms\Components\TextInput::make('title'),
                    Forms\Components\Textarea::make('description'),
                    Forms\Components\TextInput::make('author_name')->label('Author Name'),
                    Forms\Components\DatePicker::make('published_date')->label('published Date'),
                    Forms\Components\Select::make('Category')

                ->searchable()
                ->getSearchResultsUsing(fn(string $search):array=>Category::where('name', 'like', "%{$search}%")->limit(50)->pluck('name','id')->toArray())
                 ->relationship('category_id')
                ,
                    Forms\Components\Select::make('type')
                    ->options([
                        BookType::FREE->value =>Str::headline(BookType::FREE->value),
                        BookType::SUBSCRIBED->value =>Str::headline(BookType::SUBSCRIBED->value)
                    ])
                        ->label('Type'),
                Forms\Components\FileUpload::make('file')
                    ->label('Book/Audio')
                    ->directory('books')
                    ->disk('local')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
