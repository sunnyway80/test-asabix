<?php

namespace App\Http\Controllers;

use App\Entity\PaginateLimits;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @group Tag
 */
class TagController extends Controller
{
    /**
     * @var TagRepositoryInterface
     */
    private $repository;

    /**
     * @param TagRepositoryInterface $repository
     */
    public function __construct(TagRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return TagResource::collection($this->repository->paginate(PaginateLimits::ADMIN));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResource
    {
        return TagResource::make($this->repository->show($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request): JsonResource
    {
        $data = $request->only(config('translatable.locales'));

        return TagResource::make($this->repository->create($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag): JsonResource
    {
        $data = $request->only(config('translatable.locales'));

        return TagResource::make($this->repository->update($tag, $data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): ?bool
    {
        return $this->repository->delete($tag);
    }
}
