<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class protectedAccessTest extends TestCase
{
    /**
     * A basic feature test example.
     */
public function test_guest_cannot_access_dashboard()
{
    $response = $this->get('/dashboard');

    $response->assertRedirect('/login');
}
}
