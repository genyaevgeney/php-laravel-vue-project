<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $rand = rand(1, 10000000);
        $data = "testemail$rand@gmail.com";
        $response = $this->json('POST', '/api/auth/register', ['email' => $data, 'password' => $data, 'name' => $data]);
        $response->assertStatus(200);
    }
}
