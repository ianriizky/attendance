<?php

namespace App\Filament\Resources;

use App\Enums\PresenceType;
use App\Enums\UserRole;
use App\Filament\Resources\PresenceResource\Pages;
use App\Models\Employee;
use App\Models\Presence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PresenceResource extends Resource
{
    protected static ?string $model = Presence::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->label('Employee')
                    ->options(function () {
                        $query = Employee::with('user:id,name');
                        if (auth()->guard()->user()->role !== UserRole::Admin) {
                            $query->whereHas('user',
                                fn (Builder $query) => $query->whereKey(auth()->guard()->user()->getAuthIdentifier())
                            );
                        }

                        return $query->get()->pluck('user.name', 'id');
                    })
                    ->searchable(),
                Forms\Components\DateTimePicker::make('time')
                    ->required()
                    ->minDate(today())
                    ->maxDate(now()->addDays(7)->endOfDay()),
                Forms\Components\Select::make('type')
                    ->options(PresenceType::class)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->guard()->user()->role !== UserRole::Admin) {
                    return $query->whereHas('employee',
                        fn (Builder $query) => $query->whereHas('user',
                            fn (Builder $query) => $query->whereKey(auth()->guard()->user()->getAuthIdentifier())
                        )
                    );
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('employee.user.name')->label('Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('time')->dateTime(format: 'd F Y H:i:s')->sortable(),
                Tables\Columns\TextColumn::make('type')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(format: 'd F Y H:i:s')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options(PresenceType::class),
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
            'index' => Pages\ListPresences::route('/'),
            'create' => Pages\CreatePresence::route('/create'),
            'edit' => Pages\EditPresence::route('/{record}/edit'),
        ];
    }
}
