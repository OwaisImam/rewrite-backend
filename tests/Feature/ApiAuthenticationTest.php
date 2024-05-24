<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiAuthenticationTest extends TestCase
{

    public function test_registration_success_test(): void
    {
        $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
        ])->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) => $json->where('error', false)
                ->where('message', 'User registered successfully')
                ->whereType('result', 'array')
                ->has(
                    'result',
                        fn (AssertableJson $item) => $item->whereType('user', 'array')
                            ->whereType('access_token', 'string')
                            ->whereType('token_type', 'string')
                            ->where('expires_in', 0)
                    )
                );
    }

    public function test_registration_failure_test(): void
    {
       $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'admin123',
            'password_confirmation' => 'admin12312',
        ])->assertStatus(422)
        ->assertJson(
            fn (AssertableJson $json) => $json->where('error', true)
                ->whereType('messages', 'array')
                ->where('result', null)
        );
    }

    public function test_login_success_test(): void
    {
        $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'admin123',
        ])->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) => $json->where('error', false)
                ->where('message', 'User Login successfully')
                ->whereType('result', 'array')
                ->has(
                    'result',
                        fn (AssertableJson $item) => $item->whereType('user', 'array')
                            ->whereType('access_token', 'string')
                            ->where('token_type', 'bearer')
                            ->where('expires_in', 0)
                    )
                );
    }

    public function test_login_failure_test(): void
    {
        $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'admin',
        ])->assertStatus(401)
        ->assertJson(
            fn (AssertableJson $json) => $json->where('error', true)
                ->where('message', 'Invalid credentials')
                ->where('result', null)
        );
    }
}