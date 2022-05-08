<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepositoryInterface as StudentRepository;
use App\Repositories\Teacher\TeacherRepositoryInterface as TeacherRepository;
use App\Http\Requests\Admin\Student\StudentListRequest;
use App\Http\Requests\Admin\Student\StudentListDataRequest;
use App\Http\Requests\Admin\Student\StudentAddRequest;
use App\Http\Requests\Admin\Student\StudentSaveRequest;
use App\Http\Requests\Admin\Student\StudentStatusUpdateRequest;
use App\Http\Requests\Admin\Student\StudentUpdateRequest;
use App\Http\Requests\Admin\Student\StudentDeleteRequest;
use App\Http\Requests\Admin\Student\StudentEditRequest;
use App\Http\Requests\Admin\Student\StudentViewRequest;
use Yajra\DataTables\DataTables;

class StudentsController extends Controller
{

    public function list(StudentListRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['name' => "Student"]
        ];
        return view('admin.student.listStudents', compact('breadcrumbs'));
    }

    public function table(StudentListDataRequest $request, StudentRepository $studentRepo)
    {
        $students = $studentRepo->getForDatatable($request->all());
        $dataTableJSON = DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('status', function ($student) use ($request) {
                $data['url'] = $request->user()->can('student_update') ? route('student_status') : "";
                $data['id'] = $student->id;
                $data['status'] = $student->status;
                return  view('admin.elements.listStatus', compact('data'));
            })
            ->addColumn('action', function ($student) use ($request) {
                $data['edit_url'] = $request->user()->can('student_update') ? route('student_edit', ['id' => $student->id]) : "";
                $data['delete_url'] = $request->user()->can('student_delete') ? route('student_delete', ['id' => $student->id]) : "";
                return  view('admin.elements.listAction', compact('data'));
            })
            ->make();
        return $dataTableJSON;
    }

    public function add(StudentAddRequest $request, TeacherRepository $teacherRepo)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'student_list', 'name' => "Students", "permision" => "student_read"],
            ['name' => "Add Student"]
        ];
        $old = [];
        if (old('teacher_id')) {
            $old['teacher_id'] = $teacherRepo->get(old('teacher_id'));
        }
        return view('admin.student.addStudent', compact('breadcrumbs', 'old'));
    }

    public function save(StudentRepository $studentRepo, StudentSaveRequest $request)
    {
        $inputData = [
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'age' => $request->age,
            'gender' => $request->gender,
        ];
        $studentRepo->save($inputData);
        return redirect()
            ->route('student_list')
            ->with('success', 'Student added successfully');
    }

    public function view(StudentRepository $studentRepo, StudentViewRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'student_list', 'name' => "Students", "permision" => "student_read"],
            ['name' => "View Student"]
        ];
        $student = $studentRepo->get($request->id);
        return view('admin.student.viewStudent', compact('student', 'breadcrumbs'));
    }

    public function edit(StudentEditRequest $request, TeacherRepository $teacherRepo, StudentRepository $studentRepo)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'student_list', 'name' => "Students", "permision" => "student_read"],
            ['name' => "Edit Student"]
        ];
        $student = $studentRepo->get($request->id);
        $old = [];
        if (old('teacher_id', $student->teacher_id)) {
            $old['teacher_id'] = $teacherRepo->get(old('teacher_id', $student->teacher_id));
        }
        return view('admin.student.editStudent', compact('student', 'breadcrumbs', 'old'));
    }

    public function update(StudentRepository $studentRepo, StudentUpdateRequest $request)
    {
        $inputData = [
            'id' => $request->id,
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'age' => $request->age,
            'gender' => $request->gender,
            'status' => $request->status,
        ];
        $studentRepo->update($inputData);
        return redirect()
            ->route('student_list')
            ->with('success', 'Student updated successfully');
    }

    public function status(StudentRepository $studentRepo, StudentStatusUpdateRequest $request)
    {
        $data = [
            'id' => $request->id
        ];

        if ($studentRepo->statusUpdate($data)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }

    public function delete(StudentRepository $studentRepo, StudentDeleteRequest $request)
    {
        if ($studentRepo->delete($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }
}