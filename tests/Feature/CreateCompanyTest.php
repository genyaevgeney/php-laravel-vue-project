<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $rand=rand(1, 10000000);
        $data="testcompany$rand@gmail.com";
        $this->withoutMiddleware();
        Storage::fake('avatars');
        $response = $this->json('POST', '/api/companies', ['name' => $data, 'email' => $data, 'website' => 'https://laravsel.com/docs/5.8/validation#rule-url', 'logo' => UploadedFile::fake()->image('avatar.jpg')]);
        $response->assertStatus(201);
    }
}
