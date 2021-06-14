<?php
/**
 * Created by PhpStorm.
 * User: BDO
 * Date: 6/14/2021
 * Time: 11:38 PM
 */

namespace Tests\Feature;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class JobListingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_can_sync_jobs_from_api()
    {
        $this->json('GET','/syncData')
            ->assertJsonStructure(['message'])
            ->assertDontSee('error')
            ->assertOk();
    }


}