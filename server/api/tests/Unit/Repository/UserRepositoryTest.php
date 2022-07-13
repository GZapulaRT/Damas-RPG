<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testGettingOneSpecificUserFromTheDatabase(){
        /* $user = $this->createMock(UserRepository::class); */
        /* $user->method('getMultipleUsers')->willReturn('1'); */

        /* $this->assertEquals('1', $user->getMultipleUsers()); */

        $response = $this->get('/api/user/one/170');
        $response->assertStatus(200);

        $response = json_decode($response->content(), true);
        self::assertCount(1, $response);

    }

    public function testGettingOneUserThatDoesntExist(){

        $response = $this->get('/api/user/one/0');

        $response->assertStatus(404);

    }

    public function testGetting100Users(){
        $response = $this->get('/api/user');
        $response->assertOk();


        $response = json_decode($response->content(), true);
        $this->assertCount(100, $response['data']);

    }
}
