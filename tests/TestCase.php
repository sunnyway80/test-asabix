<?php

namespace Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Notification::fake();
        Storage::fake();
    }

    /**
     * Reset the migrations.
     *
     * @throws \Throwable
     */
    public function tearDown(): void
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
