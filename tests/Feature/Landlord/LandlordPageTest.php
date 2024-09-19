<?php

namespace Tests\Feature\Landlord;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandlordPageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config()->set('app.url', 'http://library.test'); // Ensure this matches your landlord URL
    }

    public function test_home_page()
    {
        $response = $this->get('/', ['host' => 'library.test']);
        $response->assertStatus(200);
    }

    public function test_login_page()
    {
        $response = $this->get('/login', ['host' => 'library.test']);
        $response->assertStatus(200);
    }

    public function test_register_page()
    {
        $response = $this->get('/register', ['host' => 'library.test']);
        $response->assertStatus(200);
    }

    public function test_password_forgot()
    {
        $response = $this->get('/password/forget', ['host' => 'library.test']);
        $response->assertStatus(200);
    }


    public function test_dashboard()
    {
        // Mock authentication if necessary
        $response = $this->actingAs(User::factory()->create())->get('/dashboard', ['host' => 'library.test']);
        $response->assertStatus(200);
    }

    // Add more tests for other routes as needed
}
