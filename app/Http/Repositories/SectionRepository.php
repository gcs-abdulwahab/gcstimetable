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

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->whereKey($id)->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $section = $this->model->find($id);
        if ($section) {
            $section->update($data);
            return $section;
        }
        return null;
    }

    public function delete($id)
    {
        $section = $this->model->find($id);
        if ($section) {
            $section->delete();
            return true;
        }
        return false;
    }

    public function getAllByShiftId($shiftId, $sectionid = null)
    {
        return $this->model->join('semesters', 'sections.semester_id', '=', 'semesters.id')
            ->join('programs', 'semesters.program_id', '=', 'programs.id')
            ->join('shifts', 'programs.shift_id', '=', 'shifts.id')
            ->where('shifts.id', $shiftId)
            ->when($sectionid, function ($query, $sectionid) {
                return $query->where('sections.id', $sectionid);
            })
            ->get(['sections.id', 'sections.name','semesters.id as SemesterId', 'semesters.name as SemesterName', 'semesters.number as SemesterNo']);
    }
}
