<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BoardCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_new_board()
    {
        // Create a test user
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Prepare valid board data
        $data = [
            'content' => 'This is a test board post.',
            'media' => null, // Adjust if media handling is required
        ];

        // Send POST request to create a new board
        $response = $this->post(route('board.store'), $data);

        // Check if the board was created in the database
        $this->assertDatabaseHas('boards', [
            'content' => 'This is a test board post.',
            'user_id' => $user->id,
        ]);

        // Check the response
        $response->assertRedirect(route('dashboard'))
                 ->assertSessionHas('success', 'Board created successfully!');
    }

    /** @test */
    public function it_fails_to_create_a_board_with_invalid_data()
    {
        // Create a test user
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Prepare invalid board data
        $data = [
            'content' => '', // Invalid content
            'media' => null, // Adjust if media handling is required
        ];

        // Send POST request to create a new board
        $response = $this->post(route('board.store'), $data);

        // Check if the board was not created in the database
        $this->assertDatabaseMissing('boards', [
            'content' => '',
            'user_id' => $user->id,
        ]);

        // Check the response for validation errors
        $response->assertSessionHasErrors(['content']);
    }
}
