<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Board;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BoardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_board()
    {
        // Simulate an authenticated user
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        // Prepare data
        $data = [
            'content' => 'Sample content',
            'media' => null
        ];

        // Send POST request to store board
        $response = $this->post(route('board.create'), $data);

        // Check if the board was created in the database
        $this->assertDatabaseHas('boards', [
            'content' => 'Sample content',
            'user_id' => $user->id,
        ]);

        // Check the response
        $response->assertRedirect(route('dashboard'))
                 ->assertSessionHas('success', 'Board created successfully!');
    }

    /** @test */
    public function it_can_upload_media_when_creating_a_board()
    {
        // Simulate an authenticated user
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        // Simulate a file upload
        Storage::fake('public');
        $file = UploadedFile::fake()->image('sample.jpg');

        // Prepare data
        $data = [
            'content' => 'Sample content with image',
            'media' => $file
        ];

        // Send POST request to store board
        $response = $this->post(route('board.create'), $data);

        // Check if the board was created in the database
        $this->assertDatabaseHas('boards', [
            'content' => 'Sample content with image',
            'user_id' => $user->id,
        ]);

        // Check if the file was uploaded
        Storage::disk('public')->assertExists('boardmedia/sample.jpg');

        // Check the response
        $response->assertRedirect(route('dashboard'))
                 ->assertSessionHas('success', 'Board created successfully!');
    }

    /** @test */
    public function it_fails_to_create_a_board_with_invalid_data()
    {
        // Simulate an authenticated user
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        // Prepare invalid data
        $data = [
            'content' => 'Short',
            'media' => null
        ];

        // Send POST request to store board
        $response = $this->post(route('board.create'), $data);

        // Check if the board was not created
        $this->assertDatabaseMissing('boards', [
            'content' => 'Short',
            'user_id' => $user->id,
        ]);

        // Check the response
        $response->assertSessionHasErrors(['content']);
    }
}
