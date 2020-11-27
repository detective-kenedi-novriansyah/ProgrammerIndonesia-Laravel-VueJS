<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Openapi;

class OpenapiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_openapi()
    {
        $openapi = Openapi::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/openapis', $openapi
        );

        $this->assertApiResponse($openapi);
    }

    /**
     * @test
     */
    public function test_read_openapi()
    {
        $openapi = Openapi::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/openapis/'.$openapi->id
        );

        $this->assertApiResponse($openapi->toArray());
    }

    /**
     * @test
     */
    public function test_update_openapi()
    {
        $openapi = Openapi::factory()->create();
        $editedOpenapi = Openapi::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/openapis/'.$openapi->id,
            $editedOpenapi
        );

        $this->assertApiResponse($editedOpenapi);
    }

    /**
     * @test
     */
    public function test_delete_openapi()
    {
        $openapi = Openapi::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/openapis/'.$openapi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/openapis/'.$openapi->id
        );

        $this->response->assertStatus(404);
    }
}
