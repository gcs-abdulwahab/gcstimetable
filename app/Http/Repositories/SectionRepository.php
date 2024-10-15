<?php

namespace App\Http\Repositories;

use App\Models\Section;

class SectionRepository
{
    protected $model;

    public function __construct(Section $section)
    {
        $this->model = $section;
    }

    public function getAllSections()
    {
        return $this->model->all();
    }

    public function getSectionById($id)
    {
        return $this->model->find($id);
    }

    public function createSection(array $data)
    {
        return $this->model->create($data);
    }

    public function updateSection($id, array $data)
    {
        $section = $this->model->find($id);
        if ($section) {
            $section->update($data);
            return $section;
        }
        return null;
    }

    public function deleteSection($id)
    {
        $section = $this->model->find($id);
        if ($section) {
            $section->delete();
            return true;
        }
        return false;
    }

    public function getAllByShiftId($shiftId)
    {
        return $this->model->join('semesters', 'sections.semester_id', '=', 'semesters.id')
            ->join('programs', 'semesters.program_id', '=', 'programs.id')
            ->join('shifts', 'programs.shift_id', '=', 'shifts.id')
            ->where('shifts.id', $shiftId)
            ->get(['sections.id', 'sections.name', 'semesters.name as SemesterName', 'semesters.number as SemesterNo']);
    }
}
