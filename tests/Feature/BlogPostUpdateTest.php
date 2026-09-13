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

    public function test_admin_can_update_blog_post_via_dedicated_post_route(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $post = $this->makePost(['slug' => 'save-via-post']);

        $response = $this->actingAs($admin)->post(route('admin.blog-posts.save', $post), [
            'title' => 'Saved Via Post',
            'slug' => 'saved-via-post',
            'excerpt' => 'Excerpt',
            'content' => "## Heading\n\nBody text.",
            'author' => 'Editor',
            'category' => 'SEO',
            'status' => 'published',
            'meta_title' => 'Meta',
            'meta_description' => 'Desc',
            'tags' => 'growth',
        ]);

        $response->assertRedirect(route('admin.blog-posts.index'));
        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'title' => 'Saved Via Post',
            'slug' => 'saved-via-post',
        ]);
        $this->assertStringEndsWith('/admin/blog-posts/'.$post->id.'/update', route('admin.blog-posts.save', $post));
    }

    public function test_admin_can_update_blog_post_with_empty_optional_fields(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $post = $this->makePost();

        $response = $this->actingAs($admin)->from(route('admin.blog-posts.edit', $post))->post(
            route('admin.blog-posts.save', $post),
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

    public function test_public_blog_show_renders_published_post(): void
    {
        $post = $this->makePost([
            'slug' => 'public-show-post',
            'content' => "## Hello\n\nThis is a **test** article.",
            'category' => 'Growth',
            'tags' => ['seo', 'web'],
        ]);

        $response = $this->get(route('blog.show', $post));

        $response->assertOk();
        $response->assertSee('Original Title', false);
        $response->assertSee('Hello', false);
        $response->assertSee('Growth', false);
    }
}
