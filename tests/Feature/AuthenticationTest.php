<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function test_if_registering_works()
    {
        $body = [
            'email' => 'localadmin@localhost.local',
            'password' => 'password'
        ];

        $response = $this->post('/api/auth/register', $body);

        $user = User::where("email", $body['email'])->firstOrFail();

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson($user->toArray());
    }

    public function test_if_logging_in_works()
    {
        $body = [
            'email' => "localadmin@localhost.local",
            'password' => "password"
        ];

        $user = new User();
        $user->email = $body['email'];
        $user->password = Hash::make($body['password']);
        $user->save();

        $response = $this->post('/api/auth/login', [
            'email' => $body['email'],
            'password' => $body['password']
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'token',
            'expires_at'
        ]);
    }

    public function test_if_getting_auth_user_works()
    {
        $user = User::factory(1)->create()->first();

        $tokenData = $user->createToken('test_token', []);

        $response = $this->get("/api/auth/user", [
            'Authorization' => 'Bearer ' . $tokenData->plainTextToken
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($user->toArray());
    }

    public function test_if_token_revoking_works()
    {
        $user = User::factory(1)->create()->first();

        $tokenData = $user->createToken('test_token', []);

        $headers = ['Authorization' => 'Bearer ' . $tokenData->plainTextToken];

        $response = $this->get("/api/auth/revoke", $headers);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $response->assertNoContent();

        $response = $this->get("/api/auth/revoke", $headers);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
