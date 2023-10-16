<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\Scopes\DepartmentScope;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTeachers extends ListRecords
{
    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
//            TeacherResource\Widgets\TeachersOverview::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'active' => Tab::make('Active')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('isActive', true)),
            'inactive' => Tab::make('InActive')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('isActive', false)),
        ];
    }
}
