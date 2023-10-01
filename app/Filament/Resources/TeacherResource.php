<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Teacher Name')->required(),
                TextInput::make('personnel_number')->label('Personal Number')->required()->unique(),
                TextInput::make('email')->label('Email')->email()->unique()->nullable(),
                TextInput::make('cnic')->label('CNIC')->unique()->nullable(),
                TextInput::make('phone_number')->label('Phone Number')->unique()->nullable(),
                TextInput::make('bank_iban')->label('Bank IBAN')->unique()->nullable(),
                Forms\Components\Select::make('isMale')->label('Gender')->options(['1' => 'Male', '0' => 'Female'])->default(true),
                Forms\Components\DatePicker::make('date_of_birth')->label('Date of Birth')->format('d/m/Y')->nullable(),
                Forms\Components\DatePicker::make('date_of_joining_in_this_college')->label('Date of Joining in College')->format('d/m/Y')->nullable(),
                Forms\Components\DatePicker::make('date_of_joining_govt_service')->label('Date of Joining in Govt Service')->format('d/m/Y')->nullable(),
                Forms\Components\DatePicker::make('date_of_joining_current_rank')->label('Date of Joining Current Rank')->format('d/m/Y')->nullable(),
                TextInput::make('father_name')->label('Father Name')->nullable(),
                TextInput::make('seniority_number')->label('Seniority Number')->numeric()->nullable(),
                Forms\Components\Select::make('qualification')->options(['MSc', 'BS(Hons)', 'MPhil', 'PhD'])->default('MPhil'),
                TextInput::make('highest_degree_awarding_institute')->label('Degree Awarding Institute')->nullable(),
                TextInput::make('highest_degree_awarding_country')->label('Degree Awarding Country')->nullable(),
                Forms\Components\DatePicker::make('highest_degree_awarding_year')->label('Degree Awarding Year')->date('Y')->nullable(),
                TextInput::make('degree_title')->label('Degree Title')->nullable(),
                Forms\Components\Select::make('rank')->options(['Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor'])->default('Lecturer'),
                Forms\Components\Select::make('position')->options(['HOD', 'Regular', 'Vice Principal', 'Principal'])->label('Position'),
                Forms\Components\Checkbox::make('isvisiting')->label('Is Visiting')->default(false),
                Forms\Components\Checkbox::make('isActive')->label('Is Active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Teacher Name'),
                Tables\Columns\TextColumn::make('personnel_number')->label('Personnel Number'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('cnic')->label('CNIC'),
                Tables\Columns\TextColumn::make('phone_number')->label('Phone Number'),
                Tables\Columns\TextColumn::make('bank_iban')->label('Bank IBAN'),
                Tables\Columns\CheckboxColumn::make('isMale')->label('Gender'),
                Tables\Columns\TextColumn::make('date_of_birth')->label('Date of Birth')->date(),
                Tables\Columns\TextColumn::make('date_of_joining_in_this_college')->label('Date of Joining in College')->date(),
                Tables\Columns\TextColumn::make('date_of_joining_govt_service')->label('Date of Joining in Govt Service')->date(),
                Tables\Columns\TextColumn::make('date_of_joining_current_rank')->label('Date of Joining Current Rank')->date(),
                Tables\Columns\TextColumn::make('father_name')->label('Father Name'),
                Tables\Columns\TextColumn::make('seniority_number')->label('Seniority Number')->numeric(),
                Tables\Columns\SelectColumn::make('qualification')
                    ->options(['MSc', 'BS(Hons)', 'MPhil', 'PhD'])
                    ->label('Qualification'),
                Tables\Columns\TextColumn::make('highest_degree_awarding_institute')
                    ->label('Degree Awarding Institute'),
                Tables\Columns\TextColumn::make('highest_degree_awarding_country')
                    ->label('Degree Awarding Country'),
                Tables\Columns\TextColumn::make('highest_degree_awarding_year')
                    ->label('Degree Awarding Year')
                    ->date('Y'),
                Tables\Columns\TextColumn::make('degree_title')->label('Degree Title'),
                Tables\Columns\SelectColumn::make('rank')
                    ->options(['Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor'])
                    ->label('Rank'),
                Tables\Columns\SelectColumn::make('position')
                    ->options(['HOD', 'Regular', 'Vice Principal', 'Principal'])
                    ->label('Position'),
                Tables\Columns\CheckboxColumn::make('isvisiting')->label('Is Visiting'),
                Tables\Columns\CheckboxColumn::make('isActive')->label('Is Active'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
