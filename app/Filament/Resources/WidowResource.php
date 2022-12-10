<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WidowResource\Pages;
use App\Filament\Resources\WidowResource\RelationManagers;
use App\Models\Widow;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class WidowResource extends Resource
{
    protected static ?string $model = Widow::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $recordTitleAttribute='cin';

    protected static ?int $navigationSort=1;

    public static ?string $label = 'Veuves';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nom'),
                Forms\Components\TextInput::make('cnss')
                    ->required()
                    ->maxLength(255)
                    ->label('Cnss')
                    ,
                Forms\Components\TextInput::make('cin')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('Cin')
                ,
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255)
                    ->label('Téléphone')
                ,
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->maxLength(65535)
                    ->label('adresse')
           
                ,
                Toggle::make('priority')->label('Proprietaire'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Nom'),
                Tables\Columns\TextColumn::make('cnss')->sortable()->searchable()->label('Cnss'),
                Tables\Columns\TextColumn::make('cin')->sortable()->searchable()->label('Cin'),
                Tables\Columns\TextColumn::make('phone')->sortable()->searchable()->label('Phone'),
                Tables\Columns\BooleanColumn::make('priority')->searchable()->label(' Proprietaire '),
                Tables\Columns\TextColumn::make('address')->sortable()->searchable()->label('Address'),


            ])
            ->filters([
                //

            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('modifier'),
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
            'index' => Pages\ListWidows::route('/'),
            'create' => Pages\CreateWidow::route('/create'),
            'edit' => Pages\EditWidow::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
       return Widow::count();
    }

    public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? __('filament::pages/dashboard.veuves');
    }


}
