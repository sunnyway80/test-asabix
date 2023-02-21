<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TagRepository.
 */
class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    /**
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        parent::__construct($tag);
    }

    public function paginate(int $limit): LengthAwarePaginator
    {
        return $this->model
            ->with('posts')
            ->latest()
            ->paginate($limit);
    }

    public function delete(Model $model): ?bool
    {
        $model->posts()->sync([]);

        $model->deleteTranslations();

        return  $model->delete();
    }
}
