<?php

namespace App\Repositories\Score;

use App\Models\Score;
use Illuminate\Database\Eloquent\Builder;

class ScoreRepository implements ScoreRepositoryInterface
{
    public function getForDatatable($data)
    {
        $score = Score::select(['*'])->with('student');
        return $score;
    }

    public function save(array $input)
    {
        if ($score =  Score::create($input)) {
            return $score;
        }
        return false;
    }

    public function get($id)
    {
        $score = Score::find($id);
        return $score;
    }

    public function getBySlug($slug)
    {
        $score = Score::where('slug', $slug)->first();
        return $score;
    }

    public function update(array $input)
    {
        $score = Score::find($input['id']);
        unset($input['id']);
        if ($score->update($input)) {
            return $score;
        }
        return false;
    }

    public function statusUpdate(array $input)
    {
        $score = Score::find($input['id']);
        $input['status'] = $score->status ? 0 : 1;
        if ($score->update($input)) {
            return $score;
        }
        return false;
    }

    public function delete(string $id)
    {
        $score = Score::find($id);
        return $score->delete();
    }
}