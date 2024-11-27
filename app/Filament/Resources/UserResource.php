<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->autocomplete(false),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique(table: User::class, ignoreRecord: true)
                    ->autocomplete(false),
                Forms\Components\TextInput::make('password')
                    ->required()
                    ->minLength(6)
                    ->password()
                    ->revealable()
                    ->confirmed()
                    ->autocomplete(false),
                Forms\Components\TextInput::make('password_confirmation')
                    ->label('Password Confirmation')
                    ->required()
                    ->minLength(6)
                    ->dehydrated(false)
                    ->password()
                    ->revealable()
                    ->autocomplete(false),
                Forms\Components\Select::make('role')
                    ->options(UserRole::class)
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options(UserStatus::class)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')->sortable(),
                Tables\Columns\TextColumn::make('role')->sortable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(format: 'd F Y H:i:s')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')->options(UserRole::class),
                Tables\Filters\SelectFilter::make('status')->options(UserStatus::class),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
