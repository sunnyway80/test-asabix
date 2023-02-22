<?php

namespace Tests\Feature;

use App\Entity\PaginateLimits;
use App\Models\Tag;
use App\Models\TagTranslation;
use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class TagTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            PostSeeder::class,
        ]);
    }

    /**
     * A basic test example.
     * @test
     */
    public function paginate(): void
    {
        $response = $this->get(route('api.tags.index'));

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($response->json())
            ->assertJsonCount(PaginateLimits::ADMIN, 'data');
    }

    /**
     * A basic test example.
     * @test
     */
    public function show(): void
    {
        $tag      = Tag::firstOrFail();
        $response = $this->getJson(route('api.tags.show', $tag->id));

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($response->json());
    }

    /**
     * A basic test example.
     * @test
     */
    public function create(): void
    {
        $response = $this->postJson(route('api.tags.store'), [
            'en' => [
                'name' => $this->faker->sentence,
            ],
            'ua' => [
                'name' => $this->faker->sentence,
            ],
            'ru' => [
                'name' => $this->faker->sentence,
            ],
        ]);

        $response->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson($response->json());

        $this->assertDatabaseHas(Tag::class, [
            'id'         => $response->json('id'),
        ]);
    }

    /**
     * A basic test example.
     * @test
     */
    public function update(): void
    {
        $tag = Tag::firstOrFail();

        $response = $this->putJson(route('api.tags.update', $tag->id), [
            'en' => [
                'name' => $this->faker->sentence,
            ],
            'ua' => [
                'name' => $this->faker->sentence,
            ],
            'ru' => [
                'name' => $this->faker->sentence,
            ],
        ]);

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($response->json());
    }

    /**
     * A basic test example.
     * @test
     */
    public function destroy(): void
    {
        $tag = Tag::query()->with('posts')->first();

        $this->assertDatabaseHas('post_tag', [
            'tag_id'         => $tag->id,
        ]);

        $response = $this->deleteJson(route('api.tags.destroy', $tag->id));

        $response->assertStatus(ResponseAlias::HTTP_OK);

        $this->assertDatabaseMissing(Tag::class, [
            'id'         => $response->json('id'),
        ]);

        $this->assertDatabaseMissing(TagTranslation::class, [
            'tag_id'         => $tag->id,
        ]);

        $this->assertDatabaseMissing('post_tag', [
            'tag_id'         => $tag->id,
        ]);
    }
}
