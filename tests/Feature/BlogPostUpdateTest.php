<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPostUpdateTest extends TestCase
{
    use RefreshDatabase;

    private function makePost(array $overrides = []): BlogPost
    {
        return BlogPost::query()->create(array_merge([
            'title' => 'Original Title',
            'slug' => 'original-title',
            'excerpt' => 'Original excerpt',
            'content' => 'Original content',
            'author' => 'Veenso Team',
            'meta_title' => 'Original meta',
            'meta_description' => 'Original meta description',
            'status' => 'published',
            'published_at' => now(),
        ], $overrides));
    }

    public function test_admin_can_update_blog_post(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $post = $this->makePost();

        $response = $this->actingAs($admin)->put(route('admin.blog-posts.update', $post), [
            'title' => 'Updated Title',
            'slug' => 'updated-title',
            'excerpt' => 'Updated excerpt',
            'content' => 'Updated content',
            'author' => 'Editor',
            'category' => 'Growth',
            'status' => 'published',
            'meta_title' => 'Updated meta',
            'meta_description' => 'Updated meta description',
            'tags' => 'seo, web',
        ]);

        $response->assertRedirect(route('admin.blog-posts.index'));
        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'slug' => 'updated-title',
            'author' => 'Editor',
        ]);
    }

    public function test_admin_can_update_blog_post_with_empty_optional_fields(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $post = $this->makePost();

        $response = $this->actingAs($admin)->from(route('admin.blog-posts.edit', $post))->put(
            route('admin.blog-posts.update', $post),
            [
                'title' => 'Still Valid',
                'slug' => '',
                'excerpt' => '',
                'content' => '',
                'author' => '',
                'status' => 'draft',
                'meta_title' => '',
                'meta_description' => '',
            ]
        );

        $response->assertRedirect(route('admin.blog-posts.index'));
        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'title' => 'Still Valid',
            'slug' => 'still-valid',
            'excerpt' => '',
            'content' => '',
            'author' => '',
            'meta_title' => '',
            'meta_description' => '',
            'status' => 'draft',
        ]);
    }
}
