<?php

namespace Tests\Feature;

use App\Entity\PaginateLimits;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class PostTest extends TestCase
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
        $response = $this->get(route('api.posts.index'));

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
        $post     = Post::firstOrFail();
        $response = $this->getJson(route('api.posts.show', $post->slug));

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($response->json());
    }

    /**
     * A basic test example.
     * @test
     */
    public function create(): void
    {
        $tags = Tag::all()->random(4)->pluck('id')->toArray();

        $response = $this->postJson(route('api.posts.store'), [
            'en' => [
                'title' => $this->faker->sentence,
                'description' => $this->faker->text,
                'content' => $this->faker->text,
            ],
            'ua' => [
                'title' => $this->faker->sentence,
                'description' => $this->faker->text,
                'content' => $this->faker->text,
            ],
            'ru' => [
                'title' => $this->faker->sentence,
                'description' => $this->faker->text,
                'content' => $this->faker->text,
            ],
            'tags' => $tags,
        ]);

        $response->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson($response->json())
            ->assertJsonCount(4, 'tags');

        $this->assertDatabaseHas(Post::class, [
            'id'         => $response->json('id'),
        ]);
    }

    /**
     * A basic test example.
     * @test
     */
    public function update(): void
    {
        $tags = Tag::all()->random(4)->pluck('id')->toArray();
        $post = Post::firstOrFail();
        $post->tags()->sync([]);

        $response = $this->putJson(route('api.posts.update', $post->id), [
            'en' => [
                'title' => $this->faker->sentence,
                'description' => $this->faker->text,
                'content' => $this->faker->text,
            ],
            'ua' => [
                'title' => $this->faker->sentence,
                'description' => $this->faker->text,
                'content' => $this->faker->text,
            ],
            'ru' => [
                'title' => $this->faker->sentence,
                'description' => $this->faker->text,
                'content' => $this->faker->text,
            ],
            'tags' => $tags,
        ]);

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($response->json())
            ->assertJsonCount(4, 'tags');
    }

    /**
     * A basic test example.
     * @test
     */
    public function destroy(): void
    {
        $post = Post::firstOrFail();

        $this->assertDatabaseHas('post_tag', [
            'post_id'         => $post->id,
        ]);

        $response = $this->deleteJson(route('api.posts.destroy', $post->id));

        $response->assertStatus(ResponseAlias::HTTP_OK);

        $this->assertDatabaseMissing(Post::class, [
            'id'         => $response->json('id'),
        ]);

        $this->assertDatabaseMissing(PostTranslation::class, [
            'post_id'         => $post->id,
        ]);

        $this->assertDatabaseMissing('post_tag', [
            'post_id'         => $post->id,
        ]);
    }
}
