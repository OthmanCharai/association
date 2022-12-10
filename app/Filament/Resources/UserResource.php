<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute='email';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required()->label('Nom'),
                TextInput::make('email')->required(),
                TextInput::make('password')->required(),
                TextInput::make('confirm-password')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


    protected static function getNavigationLabel(): string
    {
        // return static::$navigationLabel ?? __('filament::pages/dashboard.title');

        return static::$navigationLabel ?? __('filament::pages/dashboard.users');
    }

    public static function getModelLabel(): string{
        return __('filament::pages/dashboard.users');
    }

    protected static function getNavigationBadge(): ?string
    {
        return User::count();
    }
}
