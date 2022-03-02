<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use App\Interfaces\RepositoryInterface;

class BaseRepository implements RepositoryInterface {

    
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function all(): Collection 
    {
        return $this->model->all();
    }

    public function getById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $request): Model
    {
        return $this->model->create($request);
    }

    public function createMany(array $attributes): bool
    {
        return $this->model->insert($attributes);
    }

    public function update(array $request, int $id): Model
    {
        $model = $this->getById($id);
        $model->fill($request);
        $model->save();
        return $model;
    }

    public function destroy(int $id): void
    {
        $this->model->destroy($id);
    }

}