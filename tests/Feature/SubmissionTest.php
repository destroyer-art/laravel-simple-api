<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_submission_is_processed()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $response = $this->postJson('/api/submit', $data);
        $response->assertStatus(202);

        $this->assertDatabaseHas('submissions', $data);
    }

    //Test database integrity
    public function test_no_database_entry_on_invalid_data()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'message' => 'This is a test message.',
        ];

        $this->postJson('/api/submit', $data);

        $this->assertDatabaseMissing('submissions', [
            'name' => 'John Doe',
        ]);
    }

    //Test missing field
    public function test_missing_fields_return_error()
    {
        $data = [
            'name' => 'John Doe',
            // 'email' is missing
            'message' => 'This is a test message.',
        ];

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(422);

        $response->assertJsonFragment([
            'email' => ['The email field is required.'],
        ]);
    }





}
