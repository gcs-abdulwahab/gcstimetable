<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\Widgets\TeachersOverview;
use App\Models\Department;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?string $navigationGroup = 'Members';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Teacher Name')->searchable(),
                Tables\Columns\TextColumn::make('personnel_number')->label('Personnel Number')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('isMale')->label('Gender')
                    ->formatStateUsing(function (int $state): string {
                        return $state === 1 ? 'Male' : 'Female';
                    }),
                Tables\Columns\TextColumn::make('isActive')
                    ->badge()
                    ->color(fn(int $state): string => match ($state) {
                        1 => 'success',
                        0 => 'danger',
                    })
                    ->label('Is Active')
                    ->formatStateUsing(function (int $state) {
                        return ($state === 1) ? 'Active' : 'Inactive';
                    }),
                Tables\Columns\TextColumn::make('cnic')->label('CNIC'),
                Tables\Columns\TextColumn::make('phone_number')->label('Phone Number')->searchable(),
                Tables\Columns\TextColumn::make('bank_iban')->label('Bank IBAN'),
                Tables\Columns\TextColumn::make('date_of_birth')->label('Date of Birth')->date(),
                Tables\Columns\TextColumn::make('date_of_joining_in_this_college')->label('Date of Joining in College')->date(),
                Tables\Columns\TextColumn::make('date_of_joining_govt_service')->label('Date of Joining in Govt Service')->date(),
                Tables\Columns\TextColumn::make('date_of_joining_current_rank')->label('Date of Joining Current Rank')->date(),
                Tables\Columns\TextColumn::make('father_name')->label('Father Name'),
                Tables\Columns\TextColumn::make('seniority_number')->label('Seniority Number')->numeric()->searchable(),
                Tables\Columns\TextColumn::make('qualification')->label('Qualification'),
                Tables\Columns\TextColumn::make('highest_degree_awarding_institute')
                    ->label('Degree Awarding Institute'),
                Tables\Columns\TextColumn::make('highest_degree_awarding_country')
                    ->label('Degree Awarding Country'),
                Tables\Columns\TextColumn::make('highest_degree_awarding_year')
                    ->label('Degree Awarding Year')
                    ->date('Y'),
                Tables\Columns\TextColumn::make('degree_title')->label('Degree Title'),
                Tables\Columns\TextColumn::make('rank')
                    ->label('Rank'),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('isvisiting')
                    ->badge()
                    ->color(fn(int $state): string => match ($state) {
                        1 => 'success',
                        0 => 'danger',
                    })
                    ->label('Is Visiting')
                    ->formatStateUsing(function (int $state) {
                        return ($state === 1) ? 'Yes' : 'No';
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                ]),
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->fromTable()->except([
                        'id',
                        'department_id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'isMale',
                        'isActive',
                        'isvisiting',
                    ]),
                ]),

            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->paginated(false);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')
                    ->schema([
                        TextInput::make('name')->label('Teacher Name')->required(),
                        TextInput::make('personnel_number')->label('Personal Number')->required()->unique(ignorable: fn($record) => $record),
                        TextInput::make('email')->label('Email')->email()->unique(ignorable: fn($record) => $record)->nullable(),
                        TextInput::make('cnic')->label('CNIC')->unique(ignorable: fn($record) => $record)->nullable(),
                        TextInput::make('phone_number')->label('Phone Number')->unique(ignorable: fn($record) => $record)->nullable(),
                        TextInput::make('bank_iban')->label('Bank IBAN')->unique(ignorable: fn($record) => $record)->nullable(),
                        Forms\Components\Select::make('isMale')->label('Gender')->options([1 => 'Male', 0 => 'Female'])->native(false),
                        Forms\Components\DatePicker::make('date_of_birth')->label('Date of Birth')->format('Y-m-d')->nullable(),
                        Forms\Components\DatePicker::make('date_of_joining_in_this_college')->label('Date of Joining in College')->format('Y-m-d')->nullable(),
                        Forms\Components\DatePicker::make('date_of_joining_govt_service')->label('Date of Joining in Govt Service')->format('Y-m-d')->nullable(),
                        Forms\Components\DatePicker::make('date_of_joining_current_rank')->label('Date of Joining Current Rank')->format('Y-m-d')->nullable(),
                        TextInput::make('father_name')->label('Father Name')->nullable(),
                        TextInput::make('seniority_number')->label('Seniority Number')->numeric()->nullable(),
                        Forms\Components\Select::make('qualification')->options(['MSc', 'BS(Hons)', 'MPhil', 'PhD'])->default('MPhil')->native(false),
                        TextInput::make('highest_degree_awarding_institute')->label('Degree Awarding Institute')->nullable(),
                        TextInput::make('highest_degree_awarding_country')->label('Degree Awarding Country')->nullable(),
                        Forms\Components\DatePicker::make('highest_degree_awarding_year')->label('Degree Awarding Year')->format('Y')->nullable(),
                        TextInput::make('degree_title')->label('Degree Title')->nullable(),
                        Forms\Components\Select::make('rank')->options(['Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor'])->native(false),
                        Forms\Components\Select::make('position')->options(['HOD', 'Regular', 'Vice Principal', 'Principal'])->label('Position')->native(false),
                        Forms\Components\Select::make('department_id')->label('Department')->relationship('department', 'name')->required()->native(false),
                    ])->columns(2),
                Forms\Components\Checkbox::make('isvisiting')->label('Is Visiting')->default(false),
                Forms\Components\Checkbox::make('isActive')->label('Is Active')->default(true),
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

    public static function getWidgets(): array
    {
        return [
//            TeachersOverview::class
        ];
    }
}
