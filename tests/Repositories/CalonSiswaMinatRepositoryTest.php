<?php namespace Tests\Repositories;

use App\Models\CalonSiswaMinat;
use App\Repositories\CalonSiswaMinatRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CalonSiswaMinatRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CalonSiswaMinatRepository
     */
    protected $calonSiswaMinatRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->calonSiswaMinatRepo = \App::make(CalonSiswaMinatRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_calon_siswa_minat()
    {
        $calonSiswaMinat = CalonSiswaMinat::factory()->make()->toArray();

        $createdCalonSiswaMinat = $this->calonSiswaMinatRepo->create($calonSiswaMinat);

        $createdCalonSiswaMinat = $createdCalonSiswaMinat->toArray();
        $this->assertArrayHasKey('id', $createdCalonSiswaMinat);
        $this->assertNotNull($createdCalonSiswaMinat['id'], 'Created CalonSiswaMinat must have id specified');
        $this->assertNotNull(CalonSiswaMinat::find($createdCalonSiswaMinat['id']), 'CalonSiswaMinat with given id must be in DB');
        $this->assertModelData($calonSiswaMinat, $createdCalonSiswaMinat);
    }

    /**
     * @test read
     */
    public function test_read_calon_siswa_minat()
    {
        $calonSiswaMinat = CalonSiswaMinat::factory()->create();

        $dbCalonSiswaMinat = $this->calonSiswaMinatRepo->find($calonSiswaMinat->id);

        $dbCalonSiswaMinat = $dbCalonSiswaMinat->toArray();
        $this->assertModelData($calonSiswaMinat->toArray(), $dbCalonSiswaMinat);
    }

    /**
     * @test update
     */
    public function test_update_calon_siswa_minat()
    {
        $calonSiswaMinat = CalonSiswaMinat::factory()->create();
        $fakeCalonSiswaMinat = CalonSiswaMinat::factory()->make()->toArray();

        $updatedCalonSiswaMinat = $this->calonSiswaMinatRepo->update($fakeCalonSiswaMinat, $calonSiswaMinat->id);

        $this->assertModelData($fakeCalonSiswaMinat, $updatedCalonSiswaMinat->toArray());
        $dbCalonSiswaMinat = $this->calonSiswaMinatRepo->find($calonSiswaMinat->id);
        $this->assertModelData($fakeCalonSiswaMinat, $dbCalonSiswaMinat->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_calon_siswa_minat()
    {
        $calonSiswaMinat = CalonSiswaMinat::factory()->create();

        $resp = $this->calonSiswaMinatRepo->delete($calonSiswaMinat->id);

        $this->assertTrue($resp);
        $this->assertNull(CalonSiswaMinat::find($calonSiswaMinat->id), 'CalonSiswaMinat should not exist in DB');
    }
}
