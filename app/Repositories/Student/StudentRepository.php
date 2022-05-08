<?php

namespace App\Repositories\Student;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;

class StudentRepository implements StudentRepositoryInterface
{
    public function getForDatatable($data)
    {
        return Student::with(['teacher'])->select([app(Student::class)->getTable() . '.*'])
            ->where(function (Builder $query) use ($data) {
                if ($data['status'] != "") {
                    $query->where('status', '=', $data['status']);
                }
            })
            ->where(function (Builder $query) use ($data) {
                if (isset($data['teacher_id']) && $data['teacher_id'] != "") {
                    $query->where('teacher_id', '=', $data['teacher_id']);
                }
            });
    }

    public function save(array $input)
    {
        if ($student = Student::create($input)) {
            return $student;
        }
        return false;
    }

    public function get($id)
    {
        $student = Student::find($id);
        return $student;
    }

    public function getBySlug($slug)
    {
        $student = Student::where('slug', $slug)->first();
        return $student;
    }

    public function getByDivision($divisionId)
    {
        $student = Student::where('division_id', $divisionId)->where('status', 1)->get();
        return $student;
    }

    public function getAll()
    {
        return Student::where('status', 1)->get();
    }

    public function photographyCategories()
    {
        return Student::where('status', 1)->where('division_id', 1)->get();
    }

    public function resetFile(string $id)
    {
        $student = Student::find($id);
        $student->image = '';
        return $student->save();
    }

    public function update(array $input)
    {
        $student = Student::find($input['id']);
        if ($student->update($input)) {
            return $student;
        }
        return false;
    }

    public function statusUpdate(array $input)
    {
        $student = Student::find($input['id']);
        $input['status'] = $student->status ? 0 : 1;
        if ($student->update($input)) {
            return $student;
        }
        return false;
    }

    public function delete(string $id)
    {
        $student = Student::find($id);
        return $student->delete();
    }

    public function searchStudent($keyword)
    {
        $student = Student::where('name', 'like', "%{$keyword}%");
        return $student->get();
    }
}