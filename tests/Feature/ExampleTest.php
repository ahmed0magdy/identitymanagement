<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function testTheApplicationReturnsASuccessfulResponse(): never
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
