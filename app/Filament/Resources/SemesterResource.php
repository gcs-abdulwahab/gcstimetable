<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SemesterResource\Pages;
use App\Filament\Resources\SemesterResource\RelationManagers;
use App\Models\Semester;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SemesterResource extends Resource
{
    protected static ?string $model = Semester::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Program Information')
                    ->schema([

                        Forms\Components\Select::make('program_id')
                            ->relationship('program', 'name')
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('number')
                            ->required()
                            ->options([
                                1 => '1st',
                                2 => '2nd',
                                3 => '3rd',
                                4 => '4th',
                                5 => '5th',
                                6 => '6th',
                                7 => '7th',
                                8 => '8th',
                            ])
                            ->native(false),
                    ])
                    ,
                Forms\Components\Checkbox::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->sortable()
                    ->formatStateUsing(function (int $state): string {
                        return self::convertNumberToOrdinal($state);
                    })
                    ->label('Semester'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    protected static function convertNumberToOrdinal(int $value): string
    {
        // Define an array of suffixes for numbers
        $suffixes = ['st', 'nd', 'rd'];

        // Determine the suffix based on the last digit of the value
        $lastDigit = $value % 10;
        $suffix = ($lastDigit >= 1 && $lastDigit <= 3 && $value !== 11 && $value !== 12 && $value !== 13) ? $suffixes[$lastDigit - 1] : 'th';

        // Format the value with the suffix
        return $value . $suffix;
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
            'index' => Pages\ListSemesters::route('/'),
            'create' => Pages\CreateSemester::route('/create'),
            'edit' => Pages\EditSemester::route('/{record}/edit'),
        ];
    }
}
