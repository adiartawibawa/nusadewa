<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table untuk konten multi-bahasa
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('language', 2)->default('id');
            $table->enum('type', ['article', 'news', 'page', 'product', 'technology'])->default('article'); // Jenis konten
            $table->boolean('is_featured')->default(false); // Flag untuk konten unggulan
            $table->string('landing_page_section')->nullable();
            $table->integer('landing_page_order')->nullable();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_caption')->nullable();
            $table->uuid('user_id')->index();
            $table->json('meta')->nullable();
            $table->json('seo_data')->nullable();
            $table->boolean('indexable')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['slug', 'user_id', 'language']);
            $table->index(['type', 'is_featured']);
            $table->index(['is_featured', 'landing_page_section']);
        });

        // Table untuk kategori produk
        Schema::create('product_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('name');
            $table->uuid('parent_id')->nullable(); // Untuk hierarki kategori
            $table->integer('order')->default(0); // Urutan tampilan
            $table->string('icon')->nullable(); // Ikon kategori
            $table->text('description')->nullable();
            $table->uuid('user_id')->index();
            $table->json('seo_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['slug']);
            $table->index('order');
        });

        // Relasi produk dengan kategori
        Schema::create('post_product_categories', function (Blueprint $table) {
            $table->uuid('post_id');
            $table->uuid('category_id');
            $table->integer('order')->default(0); // Urutan dalam kategori
            $table->unique(['post_id', 'category_id']);
            $table->index('order');
        });

        // Table untuk tim
        Schema::create('team_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('position');
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('order')->default(0); // Urutan tampilan
            $table->json('social_links')->nullable(); // Link media sosial
            $table->json('skills')->nullable(); // Keahlian dalam format JSON
            $table->boolean('is_active')->default(true);
            $table->uuid('user_id')->nullable()->index(); // Relasi ke user jika perlu
            $table->timestamps();
            $table->softDeletes();
            $table->index('order');
            $table->index('is_active');
        });

        // Table untuk tags (seperti sebelumnya)
        Schema::create('tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('name');
            $table->uuid('user_id')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->index('created_at');
            $table->unique(['slug', 'user_id']);
        });

        // Table untuk topics (seperti sebelumnya)
        Schema::create('topics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('name');
            $table->uuid('user_id')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->index('created_at');
            $table->unique(['slug', 'user_id']);
        });

        // Table untuk relasi posts_tags (seperti sebelumnya)
        Schema::create('posts_tags', function (Blueprint $table) {
            $table->uuid('post_id');
            $table->uuid('tag_id');
            $table->unique(['post_id', 'tag_id']);
        });

        // Table untuk relasi posts_topics (seperti sebelumnya)
        Schema::create('posts_topics', function (Blueprint $table) {
            $table->uuid('post_id');
            $table->uuid('topic_id');
            $table->unique(['post_id', 'topic_id']);
        });

        // Table untuk views (seperti sebelumnya dengan tambahan)
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('post_id')->index();
            $table->string('ip')->nullable();
            $table->text('agent')->nullable();
            $table->string('referer')->nullable();
            $table->string('country_code')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });

        // Table untuk visits (seperti sebelumnya)
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('post_id');
            $table->string('ip')->nullable();
            $table->text('agent')->nullable();
            $table->string('referer')->nullable();
            $table->string('country_code')->nullable();
            $table->timestamps();
        });

        // Table untuk SEO optimization (seperti sebelumnya)
        Schema::create('seo_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('post_id')->nullable();
            $table->string('page_type'); // post, product, team, category, etc
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->json('og_data')->nullable();
            $table->json('twitter_card_data')->nullable();
            $table->json('structured_data')->nullable();
            $table->timestamps();
            $table->index(['post_id']);
        });

        // Table untuk testimoni
        Schema::create('testimonials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('author_name');
            $table->string('author_position')->nullable();
            $table->string('author_company')->nullable();
            $table->string('author_avatar')->nullable();
            $table->text('content');
            $table->integer('rating')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->index(['is_featured']);
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('seo_data');
        Schema::dropIfExists('post_product_categories');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('visits');
        Schema::dropIfExists('views');
        Schema::dropIfExists('posts_topics');
        Schema::dropIfExists('posts_tags');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('posts');
    }
};
