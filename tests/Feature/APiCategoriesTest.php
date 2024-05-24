<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class APiCategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_categories_test(): void
    {
        $user = $this->setUpUser();
        $token = JWTAuth::fromUser($user);

        $this->get('/api/categories', [
            'Authorization' => 'Bearer '.$token
        ])
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) => $json->where('error', false)
        ->where('message', 'Categories fetched succssfully.')
        ->whereType('result', 'array')
    );
    }
}