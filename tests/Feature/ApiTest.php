<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use DatabaseMigrations;

    public function test_crud()
    {
        $response = $this->getJson('/api/domains');

        $currentRecords = json_decode($response->content(), true);
        $response->assertStatus(200);

        $response = $this->postJson('/api/domains', ['domainName' => 'exampleFoo.com', 'deliveredCount' => 0, 'bouncedCount' => 0]);
        $response->assertStatus(202);
        sleep(1);

        $response = $this->getJson('/api/domains');
        $newRecords = json_decode($response->content(), true);
        $newId = $newRecords['data'][$currentRecords['count']]['id'];

        $response = $this->getJson('/api/domains/' . $newId);
        $response->assertStatus(200)->assertJson([
            'data' => [
                'domainName' => 'exampleFoo.com',
                'deliveredCount' => 0,
                'bouncedCount' => 0,
            ]
        ]);

        $response = $this->putJson('/api/domains/' . $newId, ['deliveredCount' => 1]);
        $response->assertStatus(202);
        sleep(1);

        $response = $this->getJson('/api/domains/' . $newId);
        $response->assertStatus(200)->assertJson([
            'data' => [
                'domainName' => 'exampleFoo.com',
                'deliveredCount' => 1,
                'bouncedCount' => 0,
            ]
        ]);

        $response = $this->deleteJson('/api/domains/' . $newId);
        $response->assertStatus(204);

        $response = $this->getJson('/api/domains/' . $newId);
        $response->assertStatus(404);

    }
}
