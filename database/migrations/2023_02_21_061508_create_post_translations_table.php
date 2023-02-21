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
            Schema::create('post_translations', static function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('lang_id')->index();

                $table->uuid('post_id');
                $table->unique(['post_id', 'lang_id']);

                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('cascade');

                $table->string('title');
                $table->text('description');
                $table->text('content');
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
        }
    };
