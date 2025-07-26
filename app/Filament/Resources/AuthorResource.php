<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->rules([
                    fn ($record) => \Illuminate\Validation\Rule::unique('authors', 'name')->ignore($record),
                ])
                ->label('Nama Penulis')
                ->validationMessages([
                    'unique' => 'Nama penulis ini sudah digunakan.',
                    'required' => 'Nama penulis wajib diisi.',
                ]),

            Forms\Components\TextInput::make('username')
                ->required()
                ->rules([
                    fn ($record) => \Illuminate\Validation\Rule::unique('authors', 'username')->ignore($record),
                ])
                ->label('Username')
                ->validationMessages([
                    'unique' => 'Username sudah digunakan.',
                    'required' => 'Username wajib diisi.',
                ]),

            Forms\Components\FileUpload::make('avatar')
                ->image()
                ->required(),

            Forms\Components\Textarea::make('bio')
                ->required(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')->circular(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('username'),
                Tables\Columns\TextColumn::make('bio'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
