<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Tag::factory()
            ->count(100)
            ->create();
        $postCnt = 20;
        while ($postCnt) {
            Post::factory()
                ->hasAttached(
                    Tag::all()
                        ->random(5)
                )
                ->createOne();
            $postCnt--;
        }
    }
}
