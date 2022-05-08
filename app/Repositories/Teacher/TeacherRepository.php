<?php

namespace App\Repositories\Teacher;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getForDatatable($data)
    {
        $teacher = Teacher::select(['*'])
            ->where(function (Builder $query) use ($data) {
                if ($data['status'] != "") {
                    $query->where('status', '=', $data['status']);
                }
            });
        return $teacher;
    }

    public function save(array $input)
    {
        if ($teacher =  Teacher::create($input)) {
            return $teacher;
        }
        return false;
    }

    public function get($id)
    {
        $teacher = Teacher::find($id);
        return $teacher;
    }

    public function getBySlug($slug)
    {
        $teacher = Teacher::where('slug', $slug)->first();
        return $teacher;
    }

    public function update(array $input)
    {
        $teacher = Teacher::find($input['id']);
        unset($input['id']);
        if ($teacher->update($input)) {
            return $teacher;
        }
        return false;
    }

    public function statusUpdate(array $input)
    {
        $teacher = Teacher::find($input['id']);
        $input['status'] = $teacher->status ? 0 : 1;
        if ($teacher->update($input)) {
            return $teacher;
        }
        return false;
    }

    public function delete(string $id)
    {
        $teacher = Teacher::find($id);
        return $teacher->delete();
    }

    public function getAll()
    {
        return Teacher::where('status', 1)->get();
    }

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function searchTeacher($keyword)
    {
        $teacher = Teacher::where('name', 'like', "%{$keyword}%");
        return $teacher->get();
    }
}