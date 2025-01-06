<?php

namespace Tests\Unit;

use App\Models\JobApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobApplicationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        JobApplication::factory()->count(3)->create();

        $response = $this->get(route('jobApplication.index'));

        $response->assertStatus(200);
        $response->assertViewHas('jobApplications');
    }

    public function test_create()
    {
        $response = $this->get(route('jobApplication.create'));

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $data = [
            'company_name' => 'Test Company',
            'role' => 'Test Role',
            'job_description' => 'Test Description',
            'job_requirements' => 'Test Requirements',
            'anual_salary' => 50000,
            'cv' => 'test_cv.pdf',
        ];

        $response = $this->post(route('jobApplication.store'), $data);

        $response->assertRedirect(route('jobApplication.index'));
        $this->assertDatabaseHas('job_applications', $data);
    }

    public function test_show()
    {
        $jobApplication = JobApplication::factory()->create();

        $response = $this->get(route('jobApplication.show', $jobApplication->id));

        $response->assertStatus(200);
        $response->assertViewHas('jobApplication', $jobApplication);
    }

    public function test_edit()
    {
        $jobApplication = JobApplication::factory()->create();

        $response = $this->get(route('jobApplication.edit', $jobApplication->id));

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $jobApplication = JobApplication::factory()->create();

        $data = [
            'company_name' => 'Updated Company',
            'role' => 'Updated Role',
            'job_description' => 'Updated Description',
            'job_requirements' => 'Updated Requirements',
            'anual_salary' => 60000,
            'cv' => 'updated_cv.pdf',
        ];

        $response = $this->put(route('jobApplication.update', $jobApplication->id), $data);

        $response->assertRedirect(route('jobApplication.index'));
        $this->assertDatabaseHas('job_applications', $data);
    }

    public function test_destroy()
    {
        $jobApplication = JobApplication::factory()->create();

        $response = $this->delete(route('jobApplication.destroy', $jobApplication->id));

        $response->assertRedirect(route('jobApplication.index'));
        $this->assertDatabaseMissing('job_applications', ['id' => $jobApplication->id]);
    }
}
