<?php

namespace Tests\Unit;

use App\Http\Requests\SpecialistRequest;
use App\Http\Controllers\SpecialistsController;
use App\Models\Specialist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Tests\TestCase;

class SecialistTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function index_method_displays_specialists()
    {
        // Create test data
        $specialists = Specialist::factory()->count(3)->create();

        // Create an instance of the controller
        $controller = new SpecialistsController();

        // Call the index method
        $response = $controller->index();

        // Assert the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Assert the view name is 'admin.specialist.index'
        $this->assertEquals('admin.specialist.index', $response->getName());

        // Assert the view data has 'specialists' key and its value is the created specialists
        $this->assertArrayHasKey('specialists', $response->getData());
        $this->assertEquals($specialists->toArray(), $response->getData()['specialists']->toArray());
    }

    /** @test */
    public function create_method_displays_create_form()
    {
        // Create an instance of the controller
        $controller = new SpecialistsController();

        // Call the create method
        $response = $controller->create();

        // Assert the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Assert the view name is 'admin.specialist.create'
        $this->assertEquals('admin.specialist.create', $response->getName());
    }

    /** @test */
    public function store_method_creates_specialist_and_redirects_to_index()
    {
        // Generate dummy data for the request
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            // Add other required fields here
        ];

        // Create an instance of the controller
        $controller = new SpecialistsController();

        // Create a mock SpecialistRequest object
        $request = $this->mock(SpecialistRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($data);

        // Call the store method
        $response = $controller->store($request);

        // Assert the response is an instance of RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert the redirect route is 'specialists.index'
        $this->assertEquals(route('specialists.index'), $response->headers->get('Location'));

        // Assert the specialist is created in the database
        $this->assertDatabaseHas('specialists', $data);
    }

    /** @test */
    public function edit_method_displays_edit_form_for_specified_specialist()
    {
        // Create a test specialist
        $specialist = Specialist::factory()->create();

        // Create an instance of the controller
        $controller = new SpecialistsController();

        // Call the edit method
        $response = $controller->edit($specialist);

        // Assert the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Assert the view name is 'admin.specialist.edit'
        $this->assertEquals('admin.specialist.edit', $response->getName());

        // Assert the view data has 'specialist' key and its value is the test specialist
        $this->assertArrayHasKey('specialist', $response->getData());
        $this->assertEquals($specialist->toArray(), $response->getData()['specialist']->toArray());
    }

    /** @test */
    public function update_method_updates_specified_specialist_and_redirects_to_index()
    {
        // Create a test specialist
        $specialist = Specialist::factory()->create();

        // Generate dummy data for the request
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            // Add other required fields here
        ];

        // Create an instance of the controller
        $controller = new SpecialistsController();

        // Create a mock SpecialistRequest object
        $request = $this->mock(SpecialistRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($data);

        // Call the update method
        $response = $controller->update($specialist, $request);

        // Assert the response is an instance of RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert the redirect route is 'specialists.index'
        $this->assertEquals(route('specialists.index'), $response->headers->get('Location'));

        // Assert the specialist is updated in the database
        $this->assertDatabaseHas('specialists', $data);
    }

    /** @test */
    public function destroy_method_deletes_specified_specialist_and_redirects_to_index()
    {
        // Create a test specialist
        $specialist = Specialist::factory()->create();

        // Create an instance of the controller
        $controller = new SpecialistsController();

        // Call the destroy method
        $response = $controller->destroy($specialist);

        // Assert the response is an instance of RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert the redirect route is 'specialists.index'
        $this->assertEquals(route('specialists.index'), $response->headers->get('Location'));

        // Assert the specialist is deleted from the database
        $this->assertDatabaseMissing('specialists', ['id' => $specialist->id]);
    }
}
