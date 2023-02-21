<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('post_tag', static function (Blueprint $table) {
                $table->uuid('post_id');
                $table->uuid('tag_id');

                $table->foreign('post_id')
                    ->on('posts')
                    ->references('id')
                    ->cascadeOnDelete();

                $table->foreign('tag_id')
                    ->on('tags')
                    ->references('id')
                    ->cascadeOnDelete();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('post_tags');
        }
    };
