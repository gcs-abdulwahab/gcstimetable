<?php

namespace App\Filament\Resources\TeacherResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Teacher;

class TeachersOverview extends BaseWidget
{
    protected function getStats(): array
    {
//        $totalActiveTeachers = Teacher::where('isActive', 1)->count();
        return [
            //
        ];
    }
}
