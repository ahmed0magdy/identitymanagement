<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method of the OrganizationController.
     *
     * @return void
     */
    public function testIndex()
    {
        // Create some organizations
        $organization1 = Organization::factory()->create();
        $organization2 = Organization::factory()->create();
        $organization3 = Organization::factory()->create(['ParentId' => $organization1->id]);

        // Call the index method
        $response = $this->get('/organizations');

        // Assert the response
        $response->assertOk();
        $response->assertJsonCount(1, '0.children'); // Only one top-level organization
        $response->assertJsonFragment([
            'key' => $organization1->generateKey(null),
            'label' => $organization1->displayName,
            'parent_id' => null,
            'description' => $organization1->description,
            'internalKey' => $organization1->internalKey,
            'children' => [
                [
                    'key' => $organization3->generateKey($organization1->id),
                    'label' => $organization3->displayName,
                    'parent_id' => $organization1->id,
                    'description' => $organization3->description,
                    'internalKey' => $organization3->internalKey,
                    'children' => []
                ]
            ]
        ]);
    }

    /**
     * Test the store method of the OrganizationController.
     *
     * @return void
     */
    public function testStore()
    {
        // Create a new organization
        $data = Organization::factory()->make()->toArray();
        $response = $this->post('/organizations', $data);

        // Assert the response
        $response->assertCreated();
        $response->assertJsonFragment([
            'displayName' => $data['displayName'],
            'description' => $data['description'],
            'internalKey' => $data['internalKey']
        ]);
        $this->assertDatabaseHas('organizations', $data);
    }

    /**
     * Test the show method of the OrganizationController.
     *
     * @return void
     */
    public function testShow()
    {
        // Create an organization
        $organization = Organization::factory()->create();

        // Call the show method
        $response = $this->get("/organizations/{$organization->id}");

        // Assert the response
        $response->assertOk();
        $response->assertJsonFragment([
            'displayName' => $organization->displayName,
            'description' => $organization->description,
            'internalKey' => $organization->internalKey
        ]);
    }

    /**
     * Test the update method of the OrganizationController.
     *
     * @return void
     */
    public function testUpdate()
    {
        // Create an organization
        $organization = Organization::factory()->create();

        // Update the organization
        $data = [
            'displayName' => 'New Name',
            'description' => 'New Description'
        ];
        $response = $this->put("/organizations/{$organization->id}", $data);

        // Assert the response
        $response->assertOk();
        $response->assertJsonFragment($data);
        $this->assertDatabaseHas('organizations', array_merge(['id' => $organization->id], $data));
    }

    /**
     * Test the destroy method of the OrganizationController.
     *
     * @return void
     */
    public function testDestroy()
    {
        // Create an organization
        $organization = Organization::factory()->create();

        // Call the destroy method
        $response = $this->delete("/organizations/{$organization->id}");

        // Assert the response
        $response->assertOk();
        $this->assertDeleted($organization);
    }
}
