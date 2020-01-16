<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateEmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
	$this->withoutMiddleware();
        $response = $this->json('POST', '/api/employees', ['name' => 'testcompany1@gmail.com', 'address' => 'testcompany1@gmail.com','companyName' => 'testcompany1@gmail.com']);
        $response->assertStatus(201);
    }
}
