<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Student\StudentRepositoryInterface as StudentRepository;
use App\Repositories\Teacher\TeacherRepositoryInterface as TeacherRepository;

class OptionsController extends Controller
{
    public function teachers(TeacherRepository $teacherRepo, Request $request)
    {
        $term = trim($request->q);
        $teachers = $teacherRepo->searchTeacher($term);
        $teacherOptions = [];
        foreach ($teachers as $teacher) {
            $teacherOptions[] = ['id' => $teacher->id, 'text' => $teacher->name];
        }
        return response()->json($teacherOptions);
    }

    public function students(StudentRepository $studentRepo, Request $request)
    {
        $term = trim($request->q);
        $students = $studentRepo->searchStudent($term);
        $studentOptions = [];
        foreach ($students as $student) {
            $studentOptions[] = ['id' => $student->id, 'text' => $student->name];
        }
        return response()->json($studentOptions);
    }
}