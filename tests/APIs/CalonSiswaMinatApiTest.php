<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CalonSiswaMinat;

class CalonSiswaMinatApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_calon_siswa_minat()
    {
        $calonSiswaMinat = CalonSiswaMinat::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/calon_siswa_minats', $calonSiswaMinat
        );

        $this->assertApiResponse($calonSiswaMinat);
    }

    /**
     * @test
     */
    public function test_read_calon_siswa_minat()
    {
        $calonSiswaMinat = CalonSiswaMinat::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/calon_siswa_minats/'.$calonSiswaMinat->id
        );

        $this->assertApiResponse($calonSiswaMinat->toArray());
    }

    /**
     * @test
     */
    public function test_update_calon_siswa_minat()
    {
        $calonSiswaMinat = CalonSiswaMinat::factory()->create();
        $editedCalonSiswaMinat = CalonSiswaMinat::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/calon_siswa_minats/'.$calonSiswaMinat->id,
            $editedCalonSiswaMinat
        );

        $this->assertApiResponse($editedCalonSiswaMinat);
    }

    /**
     * @test
     */
    public function test_delete_calon_siswa_minat()
    {
        $calonSiswaMinat = CalonSiswaMinat::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/calon_siswa_minats/'.$calonSiswaMinat->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/calon_siswa_minats/'.$calonSiswaMinat->id
        );

        $this->response->assertStatus(404);
    }
}
