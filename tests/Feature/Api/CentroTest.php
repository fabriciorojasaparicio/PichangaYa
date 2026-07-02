<?php

test('api centros endpoint exists and returns proper structure', function () {
    $response = $this->getJson('/api/centros');

    $response->assertStatus(200)
             ->assertJson([]);
});

test('api centro show endpoint returns 404 for non-existent centro', function () {
    $response = $this->getJson('/api/centros/999');

    $response->assertStatus(404);
});
