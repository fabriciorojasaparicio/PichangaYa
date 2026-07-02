<?php

test('api cancha show endpoint returns 404 for non-existent cancha', function () {
    $response = $this->getJson('/api/canchas/999');

    $response->assertStatus(404);
});

test('api cancha slots endpoint requires fecha parameter', function () {
    $response = $this->getJson('/api/canchas/1/slots');

    $response->assertStatus(422); // Validation error
});
