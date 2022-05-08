<?php

namespace App\Repositories\Score;

interface ScoreRepositoryInterface
{
    public function getForDatatable($data);

    public function save(array $input);

    public function get($id);

    public function getBySlug($slug);

    public function update(array $input);

    public function statusUpdate(array $input);

    public function delete(string $id);
}