<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersPostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_list_with_posts_to_publish()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Post::factory()->create([
            'user_id' => $user1->id,
            'published_at' => now()->subDay()
        ]);
        Post::factory()->create([
            'user_id' => $user2->id,
            'published_at' => now()->addDay()
        ]);

        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertDontSee($user1->email);
        $response->assertSee($user2->email);
    }
}
