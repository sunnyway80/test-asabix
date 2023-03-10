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
            Schema::create('posts', static function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name')
                    ->unique();
                $table->string('slug');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('post_translations');
            Schema::dropIfExists('post_tag');
            Schema::dropIfExists('posts');
        }
    };
