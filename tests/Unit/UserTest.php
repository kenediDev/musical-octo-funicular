<?php

namespace Tests\Unit;

use App\Models\Accounts;
use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;

class UserTest extends TestCase
{
    public function test_user_login()
    {
        $user = User::first();
        if ($user) {
            $response = $this->post('/api/v1/auth', [
                'name' => $user->email,
                'password' => "Password"
            ]);
            $response->assertStatus(200);
            $this->assertNotEquals($response['token'], null);
        } else $this->markTestSkipped("User not have data");
    }
    public function test_user_reset()
    {
        $user = User::first();
        if ($user) {
            $response = $this->post('/api/v1/auth/reset', [
                'token' => $user->email
            ]);
            $response->assertStatus(200);
            $this->assertNotEquals($response['message'], null);
            $this->assertEquals($response['message'], 'Akun telah direset, silahkan periksa inbox email anda untuk mendapatkan kata sandi baru');
        } else $this->markTestSkipped("User not have data");
    }

    public function test_user_profile()
    {
        $user = User::first();
        $faker = Faker::create();
        if ($user) {
            $response = $this->actingAs($user, 'api')->post('/api/v1/auth/update/profile', [
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                "gender" => "Male",
                "brithday" => $faker->dateTime()
            ]);
            $response->assertStatus(200);
            $this->assertNotEquals($response['message'], null);
            $this->assertEquals($response['message'], 'Profil telah diperbarui');
        } else $this->markTestSkipped("User not have data");
    }
    public function test_user_avatar()
    {
        $user = User::first();
        $faker = Faker::create();
        if ($user) {
            $response = $this->actingAs($user, 'api')->post('/api/v1/auth/update/avatar', [
                'avatar' => $faker->imageUrl()
            ]);
            $response->assertStatus(200);
            $this->assertNotEquals($response['message'], null);
            $this->assertEquals($response['message'], 'Avatar telah diperbarui');
        } else $this->markTestSkipped("User not have data");
    }
    public function test_user_background()
    {
        $user = User::first();
        $faker = Faker::create();
        if ($user) {
            $response = $this->actingAs($user, 'api')->post('/api/v1/auth/update/background', [
                'background' => $faker->imageUrl()
            ]);
            $response->assertStatus(200);
            $this->assertNotEquals($response['message'], null);
            $this->assertEquals($response['message'], 'Sampul telah diperbarui');
        } else $this->markTestSkipped("User not have data");
    }
    public function test_user_private()
    {
        $accounts = Accounts::where('is_superuser', '=', 1)->first();
        if ($accounts) {
            $response = $this->actingAs(User::find($accounts->user_id), 'api')->post('/api/v1/auth/update/private', [
                'is_superuser' => false,
                'staff' => false,
                'email' => User::orderByDesc("id")->first()->email
            ]);
            $response->assertStatus(200);
            $this->assertNotEquals($response['message'], null);
            $this->assertEquals($response['message'], 'Privasi telah diperbarui');
        } else $this->markTestSkipped("User not have data");
    }

    public function test_user_me()
    {
        $user = User::first();
        if ($user) {
            $response = $this->actingAs($user, 'api')->get("api/v1/auth");
            $response->assertStatus(200);
            $this->assertNotEquals($response, null);
        } else $this->markTestSkipped("User not have data");
    }
}
