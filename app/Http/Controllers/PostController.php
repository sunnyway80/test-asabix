<?php

namespace App\Http\Controllers;

use App\Entity\PaginateLimits;
use App\Http\Requests\TagRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @group Post
 */
class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $repository;

    /**
     * @param PostRepositoryInterface $repository
     */
    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection($this->repository->paginate(PaginateLimits::ADMIN));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): JsonResource
    {
        return PostResource::make($this->repository->showBySlug($slug));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request): JsonResource
    {
        $data = $request->only(array_merge(['tags'], config('translatable.locales')));

        return PostResource::make($this->repository->create($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Post $post): JsonResource
    {
        $data = $request->only(array_merge(['tags'], config('translatable.locales')));

        return PostResource::make($this->repository->update($post, $data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): ?bool
    {
        return $this->repository->delete($post);
    }
}
