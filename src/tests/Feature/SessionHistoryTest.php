<?php

namespace Tests\Feature;


use App\Models\User;
use App\Models\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Tests\TestCase;

class SessionHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and some sessions for testing
        $this->user = User::factory()->create();

        Session::factory()->count(12)->create(['user_id' => $this->user->id]);
    }

    public function test_get_session_history()
    {
        Passport::actingAs($this->user);
        $response = $this->get('/api/sessions/history', ['']);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'history' => [
                    '*' => [
                        'score',
                        'date',
                    ],
                ],
                'recently_trained'
            ],
        ]);
    }

    public function test_get_session_history_unauthorized()
    {

        $response = $this->get('/api/sessions/history');

        $response->assertStatus(401);
    }

}
