<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FreeShippingResource\Pages;
use App\Filament\Resources\FreeShippingResource\RelationManagers;
use App\Models\FreeShipping;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FreeShippingResource extends Resource
{
    protected static ?string $model = FreeShipping::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('threshold')->numeric()->required(),
                Forms\Components\TextInput::make('description'),
                Forms\Components\Toggle::make('is_active')->label('啟用/停用'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('threshold'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('啟用/停用'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => Pages\ListFreeShippings::route('/'),
            'create' => Pages\CreateFreeShipping::route('/create'),
            'edit' => Pages\EditFreeShipping::route('/{record}/edit'),
        ];
    }
}
