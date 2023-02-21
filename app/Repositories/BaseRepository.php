<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BaseRepository.
 */
class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function paginate(int $limit)
    {
        return $this->model->latest()
            ->paginate($limit);
    }

    public function show($id)
    {
        return $this->model::findOrFail($id);
    }

    public function showBySlug($slug)
    {
        $model = $this->model->whereSlug($slug)->first();

        if (! $model) {
            abort(Response::HTTP_NOT_FOUND, 'Model not found');
        }

        return $model;
    }

    public function create(array $data)
    {
        $model = $this->model::create($data);

        if (! $model) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'Database Error');
        }

        return $model;
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }
}
