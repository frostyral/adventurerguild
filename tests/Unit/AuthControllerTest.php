<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_register_a_new_user()
    {
        // Prepare valid registration data
        $data = [
            'name' => 'Test User',
            'class' => 'Warrior',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        // Send POST request to register the user
        $response = $this->post(route('register'), $data);

        // Check if the user was created in the database
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'class' => 'Warrior',
            // Ensure the password is hashed
            'password' => Hash::make('password123'),
        ]);

        // Check the response
        $response->assertRedirect(route('dashboard'))
                 ->assertSessionHas('success', 'Registration successful!');
    }

    /** @test */
    public function it_fails_to_register_with_invalid_data()
    {
        // Prepare invalid registration data
        $data = [
            'name' => '',
            'class' => 'Invalid Class',
            'password' => 'short',
            'password_confirmation' => 'mismatch'
        ];

        // Send POST request to register the user
        $response = $this->post(route('register'), $data);

        // Check if the user was not created in the database
        $this->assertDatabaseMissing('users', [
            'name' => '',
        ]);

        // Check the response for validation errors
        $response->assertSessionHasErrors(['name', 'password']);
    }

    /** @test */
    public function it_can_login_a_user()
    {
        // Create a test user
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Prepare login data
        $data = [
            'name' => $user->name,
            'password' => 'password123',
        ];

        // Send POST request to login
        $response = $this->post(route('login'), $data);

        // Check if the user is authenticated
        $this->assertAuthenticatedAs($user);

        // Check the response
        $response->assertRedirect(route('dashboard'))
                 ->assertSessionHas('success', 'Login successful!');
    }

    /** @test */
    public function it_fails_to_login_with_invalid_credentials()
    {
        // Create a test user
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Prepare invalid login data
        $data = [
            'name' => $user->name,
            'password' => 'wrongpassword',
        ];

        // Send POST request to login
        $response = $this->post(route('login'), $data);

        // Check if the user is not authenticated
        $this->assertGuest();

        // Check the response for login failure
        $response->assertRedirect(route('login'))
                 ->assertSessionHasErrors(['name']);
    }
}
