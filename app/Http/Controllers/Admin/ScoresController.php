<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Score\ScoreRepositoryInterface as ScoreRepository;
use App\Repositories\Student\StudentRepositoryInterface as StudentRepository;
use App\Http\Requests\Admin\Score\ScoreListRequest;
use App\Http\Requests\Admin\Score\ScoreListDataRequest;
use App\Http\Requests\Admin\Score\ScoreAddRequest;
use App\Http\Requests\Admin\Score\ScoreSaveRequest;
use App\Http\Requests\Admin\Score\ScoreStatusUpdateRequest;
use App\Http\Requests\Admin\Score\ScoreUpdateRequest;
use App\Http\Requests\Admin\Score\ScoreDeleteRequest;
use App\Http\Requests\Admin\Score\ScoreEditRequest;
use App\Http\Requests\Admin\Score\ScoreViewRequest;
use Yajra\DataTables\DataTables;

class ScoresController extends Controller
{

    public function list(ScoreListRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['name' => "Score"]
        ];
        return view('admin.score.listScores', compact('breadcrumbs'));
    }

    public function table(ScoreListDataRequest $request, ScoreRepository $scoreRepo)
    {
        $scores = $scoreRepo->getForDatatable($request->all());
        $dataTableJSON = DataTables::of($scores)
            ->addIndexColumn()
            ->addColumn('status', function ($score) use ($request) {
                $data['url'] = $request->user()->can('score_update') ? route('score_status') : "";
                $data['id'] = $score->id;
                $data['status'] = $score->status;
                return  view('admin.elements.listStatus', compact('data'));
            })
            ->addColumn('action', function ($score) use ($request) {
                $data['edit_url'] = $request->user()->can('score_update') ? route('score_edit', ['id' => $score->id]) : "";
                $data['delete_url'] = $request->user()->can('score_delete') ? route('score_delete', ['id' => $score->id]) : "";
                return  view('admin.elements.listAction', compact('data'));
            })
            ->make();
        return $dataTableJSON;
    }

    public function add(ScoreAddRequest $request, StudentRepository $studentRepo)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'score_list', 'name' => "Scores", "permision" => "score_read"],
            ['name' => "Add Score"]
        ];
        $old = [];
        if (old('student_id')) {
            $old['student_id'] = $studentRepo->get(old('student_id'));
        }
        return view('admin.score.addScore', compact('breadcrumbs', 'old'));
    }

    public function save(ScoreRepository $scoreRepo, ScoreSaveRequest $request)
    {
        $inputData = [
            'student_id' => $request->student_id,
            'maths' => $request->maths,
            'sceince' => $request->sceince,
            'history' => $request->history,
            'term' => $request->term,
        ];
        $scoreRepo->save($inputData);
        return redirect()
            ->route('score_list')
            ->with('success', 'Score added successfully');
    }

    public function view(ScoreRepository $scoreRepo, ScoreViewRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'score_list', 'name' => "Scores", "permision" => "score_read"],
            ['name' => "View Score"]
        ];
        $score = $scoreRepo->get($request->id);
        return view('admin.score.viewScore', compact('score', 'breadcrumbs'));
    }

    public function edit(ScoreEditRequest $request, ScoreRepository $scoreRepo, StudentRepository $studentRepo)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'score_list', 'name' => "Scores", "permision" => "score_read"],
            ['name' => "Edit Score"]
        ];
        $score = $scoreRepo->get($request->id);
        $old = [];
        if (old('student_id', $score->student_id)) {
            $old['student_id'] = $studentRepo->get(old('student_id', $score->student_id));
        }
        return view('admin.score.editScore', compact('score', 'breadcrumbs', 'old'));
    }

    public function update(ScoreRepository $scoreRepo, ScoreUpdateRequest $request)
    {
        $inputData = [
            'id' => $request->id,
            'student_id' => $request->student_id,
            'maths' => $request->maths,
            'sceince' => $request->sceince,
            'history' => $request->history,
            'term' => $request->term,
        ];
        $scoreRepo->update($inputData);
        return redirect()
            ->route('score_list')
            ->with('success', 'Score updated successfully');
    }

    public function status(ScoreRepository $scoreRepo, ScoreStatusUpdateRequest $request)
    {
        $data = [
            'id' => $request->id
        ];

        if ($scoreRepo->statusUpdate($data)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }

    public function delete(ScoreRepository $scoreRepo, ScoreDeleteRequest $request)
    {
        if ($scoreRepo->delete($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }
}