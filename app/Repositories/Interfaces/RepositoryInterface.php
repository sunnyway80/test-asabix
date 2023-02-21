<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface.
 */
interface RepositoryInterface
{
    public function paginate(int $limit);

    public function show(string $id);

    public function showBySlug($slug);

    public function create(array $data);

    public function update(Model $model, array $data);

    public function delete(Model $model);
}
