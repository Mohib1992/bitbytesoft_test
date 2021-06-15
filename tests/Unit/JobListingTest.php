<?php

namespace Tests\Unit;

use App\JobListing;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class JobListingTest extends TestCase
{
    use DatabaseMigrations;

    private $job;

    public function setUp(): void
    {
        parent::setUp();
        $this->jobs = factory(JobListing::class)->create([
            'title' => 'web developer',
            'description' => 'this is a description',
            'company' => 'this is a company',
            'posted_at' => Carbon::today(),
            'reference_id' => 'abcd_1234'
        ]);
    }

    /** @test */
    public function job_has_a_title()
    {
        $this->assertEquals($this->jobs->title, 'web developer');
    }

    /** @test */
    public function job_has_a_description()
    {
        $this->assertEquals($this->jobs->description, 'this is a description');
    }

    /** @test */
    public function job_has_a_company()
    {
        $this->assertEquals($this->jobs->company, 'this is a company');
    }

    /** @test */
    public function job_has_a_posted_at()
    {
        $this->assertEquals($this->jobs->posted_at, Carbon::today());
    }

    /** @test */
    public function job_has_a_reference_id()
    {
        $this->assertEquals($this->jobs->reference_id, 'abcd_1234');
    }
}
