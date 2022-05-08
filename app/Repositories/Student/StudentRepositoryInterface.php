<?php

namespace App\Repositories\Student;

interface StudentRepositoryInterface
{

    public function getForDatatable($data);

    public function save(array $input);

    public function get($id);

    public function getBySlug($slug);

    public function getByDivision($divisionId);

    public function getAll();

    public function photographyCategories();

    public function resetFile(string $id);

    public function update(array $input);

    public function statusUpdate(array $input);

    public function delete(string $id);

    public function searchStudent($keyword);
}