<?php

namespace App\Http\Controllers;

use App\Entity\PaginateLimits;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;
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
    public function store(Request $request): JsonResource
    {
        return TagResource::make($this->repository->create($request->all()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag): JsonResource
    {
        return TagResource::make($this->repository->update($tag, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): ?bool
    {
        return $this->repository->delete($tag);
    }
}
