<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\Portafolio;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PortafolioTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function portafolio_page_is_accessible()
    {
        $this->get('api/portafolios')
            ->assertOk();
    }

    /** @test */
    public function index_returns_all_portafolios()
    {
        // creamos y guardamos
        Portafolio::factory()->count(3)->create();
        $expectedPortafolios  = Portafolio::all();

        // y guardamos la respuesta a comparar
        $response = $this->get('api/portafolios');

        // verificacion
        $response->assertSuccessful();
        $response->assertJsonCount($expectedPortafolios->count());
        $response->assertJson($expectedPortafolios->toArray());
    }

    /** @test */

    public function test_store_without_image()
    {
        $data = [
            'project_title' => 'Test Project 2',
            'project_description' => 'lorem ipsum',
            'project_tech' => 'javaScript',
            'project_github' => 'https://github.com/Rodrigo-ASJ/Portafolio-Backend',
            'project_deployment' => 'https://www.test2.com',
            'project_img' => "Zz"
        ];

        $this->post('api/portafolios', $data);

        $this->assertDatabaseHas('portafolios', [
            'project_title' => 'Test Project 2',
            'project_description' => 'lorem ipsum',
            'project_tech' => 'javaScript',
            'project_github' => 'https://github.com/Rodrigo-ASJ/Portafolio-Backend',
            'project_deployment' => 'https://www.test2.com',
            'project_img' => 'noImage',
        ]);
    }

       /** @test */
    public function test_a_project_can_be_shown()
    {
        $project = Portafolio::factory()->create();

        $response = $this->get("api/portafolios/{$project->id}");
        $response->assertStatus(200);
        $response->assertJson($project->toArray());
    }

       /** @test */
    public function test_a_project_can_be_updated()
    {
        $project = Portafolio::factory()->create();
        $data = [
            'project_title' => 'Updated title',
            'project_description' => 'lorem ipsum update',
            'project_tech' => 'javaScript update',
            'project_github' => 'https://github.com/Rodrigo-ASJ/Portafolio-Backend-update',
            'project_deployment' => 'http://www.example.com/updated-link',
            'project_img' => 'updated_image_path.png'
        ];

        $response = $this->put("api/portafolios/{$project->id}", $data);
        $response->assertStatus(200);

        $updatedProject = Portafolio::find($project->id);

        $this->assertEquals($data['project_title'], $updatedProject->project_title);


        $this->assertEquals($data['project_description'], $updatedProject->project_description);

        $this->assertEquals($data['project_tech'], $updatedProject->project_tech);

        $this->assertEquals($data['project_github'], $updatedProject->project_github);

        $this->assertEquals($data['project_deployment'], $updatedProject->project_deployment);

        $this->assertEquals($data['project_img'], $updatedProject->project_img);
    }
   /** @test */
    public function test_a_project_can_be_deleted()
    {
        $project = Portafolio::factory()->create();
        $response = $this->delete("api/portafolios/{$project->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('portafolios', $project->toArray());
    }
   /** @test */
    public function test_delete_non_existing_project()
    {
        $response = $this->delete("api/portafolios/666");
        $response->assertStatus(404);
        $response->assertExactJson(['No se pudo realizar la peticion, el archivo ya no existe o nunca existio']);
    }
}
