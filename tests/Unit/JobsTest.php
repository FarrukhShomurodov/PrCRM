<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Job;
use App\Models\Salary;
use App\Models\Specialist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class JobsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function index_method_displays_jobs_and_specialists()
    {
        // Create test data
        $jobs = Job::factory()->count(3)->create();
        $specialists = Specialist::factory()->count(2)->create();

        // Send GET request to index method
        $response = $this->get(route('jobs.index'));

        // Assert response is successful
        $response->assertOk();

        // Assert the view is returned
        $response->assertViewIs('admin.jobs.index');

        // Assert jobs and specialists are passed to the view
        $response->assertViewHas('jobs', $jobs);
        $response->assertViewHas('specialists', $specialists);
    }

    /** @test */
    public function create_method_displays_create_form()
    {
        // Send GET request to create method
        $response = $this->get(route('jobs.create'));

        // Assert response is successful
        $response->assertOk();

        // Assert the view is returned
        $response->assertViewIs('admin.jobs.create');
    }

    /** @test */
    public function store_method_creates_job_and_updates_salary()
    {
        // Create a specialist
        $specialist = Specialist::factory()->create();

        // Generate dummy data for the request
        $spentTime = $this->faker->numberBetween(1, 10);
        $data = [
            'specialist_id' => $specialist->id,
            'spent_time' => $spentTime,
        ];

        // Send POST request to store method with the dummy data
        $response = $this->post(route('jobs.store'), $data);

        // Assert response redirects to jobs.index route
        $response->assertRedirect(route('jobs.index'));

        // Assert the job is created in the database
        $this->assertDatabaseHas('jobs', $data);

        // Assert the salary is updated for the specialist
        $salary = Salary::where('specialist_id', $specialist->id)->latest()->first();
        $this->assertEquals($spentTime * 50000, $salary->month);
        $this->assertEquals($spentTime, $salary->amount_of_hours);
    }

    /** @test */
    public function store_method_does_not_create_job_if_spent_time_exceeds_100()
    {
        // Create a specialist
        $specialist = Specialist::factory()->create();

        // Generate dummy data for the request with spent time exceeding 100
        $data = [
            'specialist_id' => $specialist->id,
            'spent_time' => 110,
        ];

        // Send POST request to store method with the dummy data
        $response = $this->post(route('jobs.store'), $data);

        // Assert response redirects to jobs.index route
        $response->assertRedirect(route('jobs.index'));

        // Assert the job is not created in the database
        $this->assertDatabaseMissing('jobs', $data);
    }
}
