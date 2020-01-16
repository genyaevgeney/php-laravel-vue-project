<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EditCompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->withoutMiddleware();
        $response = $this->json('POST', '/api/companies/12', ['name' => 'testcompany1@gmail.com', 'email' => 'testcompany1@gmail.com','website' => 'https://laravel.com/docs/5.8/validation#rule-url','_method' => 'put']);
        $response->assertStatus(200);
    }
}
