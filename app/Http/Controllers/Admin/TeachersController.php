<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Teacher\TeacherRepositoryInterface as TeacherRepository;
use App\Http\Requests\Admin\Teacher\TeacherListRequest;
use App\Http\Requests\Admin\Teacher\TeacherListDataRequest;
use App\Http\Requests\Admin\Teacher\TeacherAddRequest;
use App\Http\Requests\Admin\Teacher\TeacherSaveRequest;
use App\Http\Requests\Admin\Teacher\TeacherStatusUpdateRequest;
use App\Http\Requests\Admin\Teacher\TeacherUpdateRequest;
use App\Http\Requests\Admin\Teacher\TeacherDeleteRequest;
use App\Http\Requests\Admin\Teacher\TeacherEditRequest;
use App\Http\Requests\Admin\Teacher\TeacherViewRequest;
use Yajra\DataTables\DataTables;

class TeachersController extends Controller
{

    public function list(TeacherListRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['name' => "Teacher"]
        ];
        return view('admin.teacher.listTeachers', compact('breadcrumbs'));
    }

    public function table(TeacherListDataRequest $request, TeacherRepository $teacherRepo)
    {
        $teachers = $teacherRepo->getForDatatable($request->all());
        $dataTableJSON = DataTables::of($teachers)
            ->addIndexColumn()
            ->addColumn('status', function ($teacher) use ($request) {
                $data['url'] = $request->user()->can('teacher_update') ? route('teacher_status') : "";
                $data['id'] = $teacher->id;
                $data['status'] = $teacher->status;
                return  view('admin.elements.listStatus', compact('data'));
            })
            ->addColumn('action', function ($teacher) use ($request) {
                $data['edit_url'] = $request->user()->can('teacher_update') ? route('teacher_edit', ['id' => $teacher->id]) : "";
                $data['delete_url'] = $request->user()->can('teacher_delete') ? route('teacher_delete', ['id' => $teacher->id]) : "";
                return  view('admin.elements.listAction', compact('data'));
            })
            ->make();
        return $dataTableJSON;
    }

    public function add(TeacherAddRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'teacher_list', 'name' => "Teachers", "permision" => "teacher_read"],
            ['name' => "Add Teacher"]
        ];
        return view('admin.teacher.addTeacher', compact('breadcrumbs'));
    }

    public function save(TeacherRepository $teacherRepo, TeacherSaveRequest $request)
    {
        $inputData = [
            'name' => $request->name,
        ];
        $teacherRepo->save($inputData);
        return redirect()
            ->route('teacher_list')
            ->with('success', 'Teacher added successfully');
    }

    public function view(TeacherRepository $teacherRepo, TeacherViewRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'teacher_list', 'name' => "Teachers", "permision" => "teacher_read"],
            ['name' => "View Teacher"]
        ];
        $teacher = $teacherRepo->get($request->id);
        return view('admin.teacher.viewTeacher', compact('teacher', 'breadcrumbs'));
    }

    public function edit(TeacherEditRequest $request, TeacherRepository $teacherRepo)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'teacher_list', 'name' => "Teachers", "permision" => "teacher_read"],
            ['name' => "Edit Teacher"]
        ];
        $teacher = $teacherRepo->get($request->id);
        return view('admin.teacher.editTeacher', compact('teacher', 'breadcrumbs'));
    }

    public function update(TeacherRepository $teacherRepo, TeacherUpdateRequest $request)
    {
        $inputData = [
            'id' => $request->id,
            'name' => $request->name,
            'status' => $request->status,
        ];
        $teacherRepo->update($inputData);
        return redirect()
            ->route('teacher_list')
            ->with('success', 'Teacher updated successfully');
    }

    public function status(TeacherRepository $teacherRepo, TeacherStatusUpdateRequest $request)
    {
        $data = [
            'id' => $request->id
        ];

        if ($teacherRepo->statusUpdate($data)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }

    public function delete(TeacherRepository $teacherRepo, TeacherDeleteRequest $request)
    {
        if ($teacherRepo->delete($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }
}