<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildResource\Pages;
use App\Filament\Resources\ChildResource\RelationManagers;
use App\Models\Child;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ChildResource extends Resource
{

    protected static ?string $model = Child::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute='username';
    protected static ?int $navigationSort=2;




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('username')
                    ->required()
                    ->label('Nom et Prenom'),
                TextInput::make('birth_day')

                    ->required()
                            ->label('Date de naissance'),
                Select::make('widow_id')
                    ->relationship('widow', 'name')
                    ->required()
                ->label('Veuve'),

                Select::make('sponsor_id')
                    ->relationship('sponsor', 'name')
                    ->required()
                    ->label('Paraine'),
                Radio::make('gender')
                    ->options([
                        'Male' => 'M',
                        'Female' => 'F',
                    ])
                    ->columns(1)
                    ->inline()
                    ->required()
                ->label('Sixe'),
                Toggle::make('educated')
                    ->inline()
                    ->columns(1)
                    ->label('Scolarisé')
                ,
                Toggle::make('vaccinated')
                    ->label('Vaccination')
                    ->inline()->columns(1),



         /*       Forms\Components\TextInput::make('cnss')->required(),
                Forms\Components\TextInput::make('cin')->required()->unique(),
                Forms\Components\TextInput::make('phone')->required(),
                Forms\Components\TextInput::make('address')->required(),*/

            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('username')->sortable()->searchable()->label('Nom et Prenom'),
                Tables\Columns\TextColumn::make('age')->sortable(),
                Tables\Columns\TextColumn::make('widow.name')->sortable()->searchable()->label('Veuve'),
                Tables\Columns\TextColumn::make('gender')->sortable()->searchable()->label('Sixe'),
                Tables\Columns\BooleanColumn::make('educated')->sortable()->searchable()->label('Scolarisé'),
                Tables\Columns\BooleanColumn::make('vaccinated')->sortable()->searchable()->label('Vaccination'),


            ])
            ->filters([
                //
                    Tables\Filters\Filter::make('Male')
                        ->query(static fn (Builder $query): Builder => $query->where('gender','Male'))
                        ->label('M'),
                Tables\Filters\Filter::make('Female')
                    ->query(static fn (Builder $query): Builder => $query->where('gender','Female'))
                    ->label('F')
                ,
                Tables\Filters\Filter::make('Educated')
                    ->query(static fn (Builder $query): Builder => $query->where('educated',true))
                ->label('Scolarisé'),
                Tables\Filters\Filter::make('Vaccinated')
                    ->query(static fn (Builder $query): Builder => $query->where('vaccinated',true))
                ->label('Vaccination'),
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
            'index' => Pages\ListChildren::route('/'),
            'create' => Pages\CreateChild::route('/create'),
            'edit' => Pages\EditChild::route('/{record}/edit'),
        ];
    }
    protected static function getNavigationBadge(): ?string
    {
        return Child::count();
    }

    protected static function getNavigationLabel(): string
    {
       // return static::$navigationLabel ?? __('filament::pages/dashboard.title');

       return static::$navigationLabel ?? __('filament::pages/dashboard.children');
    }

    public static function getModelLabel(): string{
        return __('filament::pages/dashboard.children');
    }





}
