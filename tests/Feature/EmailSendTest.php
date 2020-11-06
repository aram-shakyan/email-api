<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EmailSendTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUnauthenticated()
    {
        $response = $this->post('/api/email/send', [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
        $response->assertExactJson([
            "message" => "Unauthenticated."
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testValidation()
    {
        $user = User::query()->create([
            'name' => 'Test User',
            'email' => 'test@exampleunit.com',
            'password' => Hash::make('secret')
        ]);

        $token = $user->createToken('test');
        $tokenAuth = $token->plainTextToken;

        $response = $this->post('/api/email/send', [], [
            'Authorization' => "Bearer $tokenAuth",
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            "message",
            "errors"  => ["message"]
        ]);

        $user->delete();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccess()
    {
        $user = User::query()->create([
            'name' => 'Test User',
            'email' => 'test@exampleunit.com',
            'password' => Hash::make('secret')
        ]);

        $token = $user->createToken('test');
        $tokenAuth = $token->plainTextToken;

        $response = $this->post('/api/email/send', ['message' => 'test-message'], [
            'Authorization' => "Bearer $tokenAuth",
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $response->assertExactJson([
            "success" => true,
            "message" => "The Email sending added in queue"
        ]);

        $user->delete();
    }
}
