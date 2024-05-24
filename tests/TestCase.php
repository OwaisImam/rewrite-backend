<?php

namespace Tests;

use App\Constants\DefaultValues;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        $this->setUpFaker();
        parent::setUp();

        $this->user = $this->setUpUser();
    }

    protected function setUpUser(): User
    {
        return User::factory()->create([
            'status' => DefaultValues::ACTIVE,
        ]);
    }
}