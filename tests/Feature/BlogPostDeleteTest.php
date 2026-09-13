<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\BlogPostImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPostDeleteTest extends TestCase
{
    use RefreshDatabase;

    private function makePost(array $overrides = []): BlogPost
    {
        return BlogPost::query()->create(array_merge([
            'title' => 'Delete Me',
            'slug' => 'delete-me-'.uniqid(),
            'excerpt' => 'Excerpt',
            'content' => 'Content',
            'author' => 'Admin',
            'meta_title' => 'Meta',
            'meta_description' => 'Meta desc',
            'status' => 'published',
            'published_at' => now(),
        ], $overrides));
    }

    public function test_admin_can_delete_blog_post_via_delete_method(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $post = $this->makePost(['slug' => 'delete-via-delete']);

        $response = $this->actingAs($admin)->from(route('admin.blog-posts.index'))->delete(
            route('admin.blog-posts.destroy', $post)
        );

        $response->assertRedirect(route('admin.blog-posts.index'));
        $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
    }

    public function test_admin_can_delete_blog_post_via_post_method_spoof(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $post = $this->makePost(['slug' => 'delete-via-post']);

        $response = $this->actingAs($admin)->from(route('admin.blog-posts.index'))->post(
            route('admin.blog-posts.destroy', $post),
            ['_method' => 'DELETE']
        );

        $response->assertRedirect(route('admin.blog-posts.index'));
        $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
    }

    public function test_admin_can_delete_blog_post_with_gallery_images(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $post = $this->makePost(['slug' => 'delete-with-images']);

        BlogPostImage::query()->create([
            'blog_post_id' => $post->id,
            'path' => 'blog/gallery/test.jpg',
            'alt' => 'Alt',
            'caption' => 'Caption',
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.blog-posts.destroy', $post));

        $response->assertRedirect(route('admin.blog-posts.index'));
        $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
        $this->assertDatabaseMissing('blog_post_images', ['blog_post_id' => $post->id]);
    }
}
