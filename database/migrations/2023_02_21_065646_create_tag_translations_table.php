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
            Schema::create('tag_translations', static function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('lang_id')->index();

                $table->uuid('tag_id');
                $table->unique(['tag_id', 'lang_id']);
                $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade');

                $table->string('name');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('post_tag_translations');
        }
    };
