<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model;
    }

    // create a new record in the database
    public function create(array $data)
    {
        $data['created_at'] = Carbon::now();
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $data['updated_at'] = Carbon::now();
        $record = $this->find($id);
        return $record->update($data);
    }

  

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function where($field, $value, $operator)
    {
        return $this->model->where($field, $operator, $value);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}