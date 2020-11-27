<?php namespace Tests\Repositories;

use App\Models\Openapi;
use App\Repositories\OpenapiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OpenapiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OpenapiRepository
     */
    protected $openapiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->openapiRepo = \App::make(OpenapiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_openapi()
    {
        $openapi = Openapi::factory()->make()->toArray();

        $createdOpenapi = $this->openapiRepo->create($openapi);

        $createdOpenapi = $createdOpenapi->toArray();
        $this->assertArrayHasKey('id', $createdOpenapi);
        $this->assertNotNull($createdOpenapi['id'], 'Created Openapi must have id specified');
        $this->assertNotNull(Openapi::find($createdOpenapi['id']), 'Openapi with given id must be in DB');
        $this->assertModelData($openapi, $createdOpenapi);
    }

    /**
     * @test read
     */
    public function test_read_openapi()
    {
        $openapi = Openapi::factory()->create();

        $dbOpenapi = $this->openapiRepo->find($openapi->id);

        $dbOpenapi = $dbOpenapi->toArray();
        $this->assertModelData($openapi->toArray(), $dbOpenapi);
    }

    /**
     * @test update
     */
    public function test_update_openapi()
    {
        $openapi = Openapi::factory()->create();
        $fakeOpenapi = Openapi::factory()->make()->toArray();

        $updatedOpenapi = $this->openapiRepo->update($fakeOpenapi, $openapi->id);

        $this->assertModelData($fakeOpenapi, $updatedOpenapi->toArray());
        $dbOpenapi = $this->openapiRepo->find($openapi->id);
        $this->assertModelData($fakeOpenapi, $dbOpenapi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_openapi()
    {
        $openapi = Openapi::factory()->create();

        $resp = $this->openapiRepo->delete($openapi->id);

        $this->assertTrue($resp);
        $this->assertNull(Openapi::find($openapi->id), 'Openapi should not exist in DB');
    }
}
