<?php namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function where($field, $value, $operator);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);

    public function with($relations);
}