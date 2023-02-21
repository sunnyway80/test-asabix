<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PostRepository.
 */
class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    public function paginate(int $limit): LengthAwarePaginator
    {
        return $this->model
            ->with('tags')
            ->latest()
            ->paginate($limit);
    }

    public function create(array $data)
    {
        $data['name'] = $data['en']['title'] ?? '';

        $model = parent::create($data);

        $model->tags()->sync($data['tags']);

        $model->load('tags');

        return $model;
    }

    public function update(Model $model, array $data): Model
    {
        $data['name'] = $data['en']['title'] ?? '';

        $model = parent::update($model, $data);

        $model->tags()->sync($data['tags']);

        $model->load('tags');

        return $model;
    }

    public function delete(Model $model): ?bool
    {
        $model->tags()->sync([]);

        $model->deleteTranslations();

        return  $model->delete();
    }
}
