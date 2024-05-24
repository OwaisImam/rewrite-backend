<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiDailyNotificationStatusUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_daily_notification_status_update_test(): void
    {
        $user = $this->setUpUser();

        $token = JWTAuth::fromUser($user);

        $this->postJson('/api/daily_notification/update', [
            "is_notification_on" => $this->faker->boolean()
        ], [
            'Authorization' => 'Bearer ' . $token
        ])->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('error', false)
            ->where('message', 'Status updated successfully.')
            ->whereType('result', 'array')
        );
    }

    public function test_daily_notification_status_update_failure_test(): void
    {
        $this->postJson('/api/daily_notification/update', [
            "is_notification_on" => $this->faker->boolean()
        ])->assertStatus(401)
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('message', 'Unauthenticated.')
        );
    }
}