<?php

namespace Tests\Feature\Users;


use App\Models\User;
use Tests\TestCase;

class ListUserTest extends TestCase
{
    /** @test */
    public function can_fetch_user(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/user');

        $response->assertSee($user->name);
    }
}
