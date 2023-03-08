<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnprTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_detect_plat_nomor()
    {
        $response = $this->post('/');

        $response->assertStatus(200);
    }
}
